<?php

namespace App\Http\Controllers\CourseAdmin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\StudentCertificate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CourseAdminAnalyticsController extends Controller
{
    public function index()
    {
        $adminId = Auth::guard('course_admin')->id();

        // 1. Ringkasan Kartu
        $totalCourses = Course::where('course_admin_id', $adminId)->count();
        
        $myCourseIds = Course::where('course_admin_id', $adminId)->pluck('id');
        
        $totalCertificates = StudentCertificate::whereIn('course_id', $myCourseIds)->count();

        // Menghitung total siswa unik yang terdaftar di kursus saya
        // Ini perlu query ke pivot table course_student (asumsi nama tabel pivot standar)
        // Atau jika relasi 'students' di Course model sudah ada:
        $totalStudents = DB::table('course_student')
            ->whereIn('course_id', $myCourseIds)
            ->distinct('student_id')
            ->count('student_id');

        // 2. Data Tabel / Chart Sederhana: Performa Kursus
        $coursePerformance = Course::where('course_admin_id', $adminId)
            ->withCount('students') // Asumsi relasi students() ada di Course model
            ->withCount(['certificates' => function ($query) {
                // Asumsi relasi certificates() ada di Course model (hasMany)
                // Jika tidak ada, kita bisa eager load manual atau hitung terpisah
            }])
            ->get()
            ->map(function ($course) {
                // Hitung Completion Rate
                $completionRate = $course->students_count > 0 
                    ? round(($course->certificates_count / $course->students_count) * 100, 1) 
                    : 0;
                
                return [
                    'name' => $course->name,
                    'students' => $course->students_count,
                    'certificates' => $course->certificates_count,
                    'completion_rate' => $completionRate,
                ];
            });

        return view('course_admin.analytics.index', compact('totalCourses', 'totalStudents', 'totalCertificates', 'coursePerformance'));
    }
}
