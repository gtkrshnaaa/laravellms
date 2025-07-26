<?php

namespace App\Http\Controllers\CourseAdmin\CourseManagement;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseAdminManageCourseTopicQuizQuestionController extends Controller
{
    /**
     * Menampilkan halaman manajemen soal untuk kuis tertentu.
     */
    public function index(Quiz $quiz)
    {
        // Ambil kuis beserta relasi pertanyaan dan opsi jawabannya
        $quiz->load('questions.options');
        return view('course_admin.dashboard.course_management.materials.quizzes.questions.index', compact('quiz'));
    }

    /**
     * Menyimpan pertanyaan baru beserta opsi jawabannya.
     */
    public function store(Request $request, Quiz $quiz)
    {
        $request->validate([
            'question_text' => 'required|string',
            'options' => 'required|array|min:2', // Pastikan ada minimal 2 opsi
            'options.*' => 'required|string', // Pastikan setiap opsi tidak kosong
            'correct_option' => 'required|integer', // Index dari opsi yang benar
        ]);

        // Gunakan transaction untuk memastikan data konsisten
        DB::transaction(function () use ($request, $quiz) {
            // 1. Buat Pertanyaan
            $question = $quiz->questions()->create([
                'question_text' => $request->question_text,
            ]);

            // 2. Simpan Opsi Jawaban
            foreach ($request->options as $index => $optionText) {
                $question->options()->create([
                    'option_text' => $optionText,
                    // Tandai sebagai jawaban yang benar jika index-nya cocok
                    'is_correct' => ($index == $request->correct_option),
                ]);
            }
        });

        return redirect()->route('course_admin.management.quizzes.questions.index', $quiz)
                         ->with('success', 'Soal berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit soal.
     */
    public function edit(Quiz $quiz, QuizQuestion $question)
    {
        // Pastikan relasi options sudah di-load
        $question->load('options');
        return view('course_admin.dashboard.course_management.materials.quizzes.questions.edit', compact('quiz', 'question'));
    }

    /**
     * Memperbarui data soal di database.
     */
    public function update(Request $request, Quiz $quiz, QuizQuestion $question)
    {
        $request->validate([
            'question_text' => 'required|string',
            'options' => 'required|array|min:2',
            'options.*' => 'required|string',
            'correct_option' => 'required|integer',
        ]);
        
        if ($request->correct_option >= count($request->options)) {
            return back()->withErrors(['correct_option' => 'Opsi jawaban benar tidak valid.'])->withInput();
        }

        DB::transaction(function () use ($request, $question) {
            // 1. Update teks pertanyaan
            $question->update(['question_text' => $request->question_text]);

            // 2. Hapus opsi lama
            $question->options()->delete();

            // 3. Buat ulang opsi yang baru
            foreach ($request->options as $index => $optionText) {
                $question->options()->create([
                    'option_text' => $optionText,
                    'is_correct' => ($index == $request->correct_option),
                ]);
            }
        });

        return redirect()->route('course_admin.management.quizzes.questions.index', $quiz)
                         ->with('success', 'Soal berhasil diperbarui.');
    }

    /**
     * Menghapus soal dari database.
     */
    public function destroy(Quiz $quiz, QuizQuestion $question)
    {
        $question->delete(); // Karena ada onDelete('cascade') di migrasi, options akan ikut terhapus.

        return redirect()->route('course_admin.management.quizzes.questions.index', $quiz)
                         ->with('success', 'Soal berhasil dihapus.');
    }
}