<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Completion;
use App\Models\StudentCertificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $student = Auth::guard('student')->user();

        // Hitung total kursus yang diikuti
        $totalEnrolledCourses = $student->courses()->count();

        // Hitung total sertifikat langsung dari tabelnya
        $totalCertificates = StudentCertificate::where('student_id', $student->id)->count();

        // Inisialisasi koleksi untuk kursus yang sedang berjalan dan yang sudah selesai
        $inProgressCourses = collect();
        $completedCoursesList = collect(); // Mengubah nama agar tidak bentrok dengan completedCoursesCount

        $enrolledCourses = $student->courses; // Ambil semua kursus yang diikuti

        $completedCoursesCount = 0; // Tetap hitung jumlahnya
        foreach ($enrolledCourses as $course) {
            $progress = $course->getProgressPercentageForStudent($student);
            
            // Tambahkan properti progress ke objek course agar mudah diakses di view
            $course->current_progress = $progress;

            if ($progress === 100) {
                $completedCoursesList->push($course);
                $completedCoursesCount++; // Tambah hitungan kursus selesai
            } elseif ($progress > 0 && $progress < 100) {
                $inProgressCourses->push($course);
            }
        }
        
        // Urutkan kursus yang sedang berjalan berdasarkan progres (misal, dari paling tinggi ke rendah)
        $inProgressCourses = $inProgressCourses->sortByDesc('current_progress');


        // Tidak ada lagi continuingCourse dan maxProgress tunggal, diganti koleksi

        return view('student.dashboard.index', compact(
            'student',
            'totalEnrolledCourses',
            'totalCertificates',
            'completedCoursesCount', // Ini tetap jumlah total kursus selesai
            'inProgressCourses',    // Koleksi kursus yang sedang berjalan
            'completedCoursesList'  // Koleksi kursus yang sudah 100% selesai
        ));
    }
}