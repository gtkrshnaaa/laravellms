<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Topic;
use App\Models\Video;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\Completion;
use App\Models\GoogleDriveMaterial;
use App\Models\StudentCertificate; 
use Illuminate\Support\Str; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentEnrolledCourseController extends Controller
{
    /**
     * Menampilkan daftar kursus yang sudah diikuti oleh student.
     */
    public function index()
    {
        $student = Auth::guard('student')->user();
        $enrolledCourses = $student->courses()->latest()->paginate(9);
        return view('student.dashboard.enrolled_course.index', compact('enrolledCourses'));
    }

    /**
     * Menampilkan halaman belajar utama. Akan me-redirect ke materi pertama.
     */
    public function show(Course $course)
    {
        $this->authorizeEnrollment($course);
        $firstMaterial = $this->getOrderedMaterials($course)->first();

        if (!$firstMaterial) {
            return view('student.dashboard.enrolled_course.show', [
                'course' => $course,
                'materials' => collect(),
                'current_material' => null,
                'previous_material' => null,
                'next_material' => null,
            ]);
        }

        // Redirect ke route yang sesuai dengan tipe materi pertama
        $route = $this->getRouteForMaterial($course, $firstMaterial);
        return redirect($route);
    }

    /**
     * Menampilkan materi berupa Video.
     */
    public function showVideo(Course $course, Video $video)
    {
        $this->authorizeEnrollment($course);
        $this->authorizeTopicAccess($course, $video->topic);
        return $this->renderLearnPageView($course, $video);
    }

    /**
     * Menampilkan materi berupa Kuis.
     */
    public function showQuiz(Course $course, Quiz $quiz)
    {
        $student = Auth::guard('student')->user();
        $this->authorizeEnrollment($course);
        $this->authorizeTopicAccess($course, $quiz->topic);
        $quiz->load('questions.options');

        $lastAttempt = QuizAttempt::where('student_id', $student->id)
            ->where('quiz_id', $quiz->id)
            ->latest()
            ->first();

        return $this->renderLearnPageView($course, $quiz, $lastAttempt);
    }

    /**
     * Menampilkan materi berupa Google Drive Material.
     */
    public function showGoogleDriveMaterial(Course $course, GoogleDriveMaterial $googleDriveMaterial)
    {
        $this->authorizeEnrollment($course);
        $this->authorizeTopicAccess($course, $googleDriveMaterial->topic);
        return $this->renderLearnPageView($course, $googleDriveMaterial);
    }

    /**
     * Method utama untuk me-render view halaman belajar.
     */
    private function renderLearnPageView(Course $course, \Illuminate\Database\Eloquent\Model $material, $lastAttempt = null)
    {
        $student = Auth::guard('student')->user();
        $course->load('followUpLinks');
        $materials = $this->getOrderedMaterials($course);
        $navigation = $this->getMaterialNavigation($materials, $material);
        $completedMaterials = $student->completions()->get()->keyBy(function ($item) {
            return $item->completable_type . '-' . $item->completable_id;
        });

        return view('student.dashboard.enrolled_course.show', [
            'course' => $course,
            'materials' => $materials,
            'current_material' => $material,
            'previous_material' => $navigation['previous'],
            'next_material' => $navigation['next'],
            'lastAttempt' => $lastAttempt,
            'completedMaterials' => $completedMaterials,
        ]);
    }

    /**
     * Menandai materi sebagai selesai dan lanjut ke materi berikutnya.
     */
    public function markAsComplete(Request $request, Course $course, $completable_type, $completable_id)
    {
        $student = Auth::guard('student')->user();
        $this->authorizeEnrollment($course);

        $modelClass = match ($completable_type) {
            'video' => Video::class,
            'quiz' => Quiz::class,
            'googledrive' => GoogleDriveMaterial::class,
            default => abort(404),
        };
        $material = $modelClass::findOrFail($completable_id);

        Completion::updateOrCreate([
            'student_id' => $student->id,
            'completable_id' => $material->id,
            'completable_type' => $modelClass,
        ]);

        $this->checkAndGenerateCertificate($course, $student);

        $materials = $this->getOrderedMaterials($course);
        $navigation = $this->getMaterialNavigation($materials, $material);
        $next_material = $navigation['next'];

        if ($next_material) {
            // [FIXED] Gunakan helper untuk mendapatkan route yang benar
            $next_route = $this->getRouteForMaterial($course, $next_material);
            return redirect($next_route)->with('success', 'Materi ditandai selesai!');
        }

        return redirect()->route('student.enrolled_course.index')->with('success', 'Selamat! Anda telah menyelesaikan kursus ' . $course->name);
    }

    /**
     * Memproses jawaban kuis.
     */
    public function submitQuiz(Request $request, Course $course, Quiz $quiz)
    {
        $student = Auth::guard('student')->user();
        $this->authorizeEnrollment($course);

        $answers = $request->input('answers', []);
        $correct_answers_count = 0;
        
        $quiz->load('questions.options');
        $total_questions = $quiz->questions->count();

        foreach ($quiz->questions as $question) {
            $correct_option_id = $question->options->where('is_correct', true)->first()->id;
            if (isset($answers[$question->id]) && $answers[$question->id] == $correct_option_id) {
                $correct_answers_count++;
            }
        }

        $score = ($total_questions > 0) ? ($correct_answers_count / $total_questions) * 100 : 0;
        $passed = $score >= $quiz->min_score;

        QuizAttempt::create([
            'student_id' => $student->id,
            'quiz_id' => $quiz->id,
            'score' => $score,
            'passed' => $passed,
        ]);

        if ($passed) {
            Completion::updateOrCreate([
                'student_id' => $student->id,
                'completable_id' => $quiz->id,
                'completable_type' => Quiz::class,
            ]);

            $this->checkAndGenerateCertificate($course, $student);

            $materials = $this->getOrderedMaterials($course);
            $navigation = $this->getMaterialNavigation($materials, $quiz);
            $next_material = $navigation['next'];

            if ($next_material) {
                $next_route = $this->getRouteForMaterial($course, $next_material);
                return redirect($next_route)->with('success', "Selamat, Anda lulus kuis dengan skor " . round($score) . "!");
            } else {
                return redirect()->route('student.enrolled_course.index')->with('success', 'Selamat! Anda telah menyelesaikan kursus ' . $course->name);
            }
        } else {
            return redirect()->back()->with('error', "Skor Anda " . round($score) . ". Anda belum memenuhi skor minimum (" . $quiz->min_score . "). Silakan coba lagi.");
        }
    }

    // --- HELPER METHODS ---

    private function authorizeEnrollment(Course $course)
    {
        if (!Auth::guard('student')->user()->courses()->where('course_id', $course->id)->exists()) {
            abort(403, 'Akses ditolak. Anda belum terdaftar di kursus ini.');
        }
    }

    private function authorizeTopicAccess(Course $course, Topic $currentTopic)
    {
        $student = Auth::guard('student')->user();
        $topics = $course->topics()->orderBy('order')->get();
        $previousTopic = null;

        foreach ($topics as $topic) {
            if ($topic->id === $currentTopic->id) {
                if ($previousTopic && !$student->isTopicCompleted($previousTopic)) {
                    abort(403, 'Anda harus menyelesaikan topik sebelumnya terlebih dahulu.');
                }
                return;
            }
            $previousTopic = $topic;
        }
    }

    private function getOrderedMaterials(Course $course): \Illuminate\Support\Collection
    {
        $course->load(['topics.videos', 'topics.quizzes', 'topics.googleDriveMaterials']);
        
        $materials = collect();
        foreach ($course->topics as $topic) {
            $topicMaterials = $topic->videos
                                ->concat($topic->quizzes)
                                ->concat($topic->googleDriveMaterials);
            
            $sortedTopicMaterials = $topicMaterials->sortBy('order')->values();
            $materials = $materials->concat($sortedTopicMaterials);
        }
        return $materials;
    }

    private function getMaterialNavigation(\Illuminate\Support\Collection $materials, \Illuminate\Database\Eloquent\Model $current): array
    {
        $currentIndex = $materials->search(function ($item) use ($current) {
            return $item->id == $current->id && get_class($item) == get_class($current);
        });

        if ($currentIndex === false) {
            return ['previous' => null, 'next' => null];
        }

        return [
            'previous' => $materials->get($currentIndex - 1),
            'next' => $materials->get($currentIndex + 1),
        ];
    }
    
    /**
     * [FIXED] Helper baru untuk menentukan route berdasarkan tipe materi.
     */
    private function getRouteForMaterial(Course $course, \Illuminate\Database\Eloquent\Model $material): string
    {
        return match (get_class($material)) {
            Video::class => route('student.enrolled_course.video', [$course, $material]),
            Quiz::class => route('student.enrolled_course.quiz', [$course, $material]),
            GoogleDriveMaterial::class => route('student.enrolled_course.googledrive', [$course, $material]),
            default => '#',
        };
    }

    /**
     * Helper untuk cek progres dan generate sertifikat.
     */
    private function checkAndGenerateCertificate(Course $course, \App\Models\Student $student)
    {
        // Cek jika progres sudah 100%
        if ($course->getProgressPercentageForStudent($student) >= 100) {
            // Buat record sertifikat jika belum ada
            StudentCertificate::firstOrCreate(
                [
                    'student_id' => $student->id,
                    'course_id' => $course->id,
                ],
                [
                    'completed_at' => now(),
                    'verification_token' => Str::random(40), // Buat token unik
                ]
            );
        }
    }
}