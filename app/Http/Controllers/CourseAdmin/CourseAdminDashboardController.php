<?php

// FILE: app/Http/Controllers/CourseAdmin/CourseAdminDashboardController.php

namespace App\Http\Controllers\CourseAdmin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CourseAdminDashboardController extends Controller
{
    public function index()
    {
        $admin = Auth::guard('course_admin')->user();

        // Ambil semua ID kursus yang dimiliki oleh admin ini
        $adminCourseIds = $admin->courses()->pluck('id');

        // --- 1. Statistik Utama (Kartu) ---
        $stats = [
            'total_courses' => $adminCourseIds->count(),
            
            // Hitung siswa unik di semua kursus milik admin
            'total_students' => DB::table('enrollments')
                                    ->whereIn('course_id', $adminCourseIds)
                                    ->distinct('student_id')
                                    ->count('student_id'),
        ];

        // --- 2. Kursus Terpopuler (berdasarkan jumlah siswa) ---
        $popularCourses = Course::whereIn('id', $adminCourseIds)
                                ->withCount('students') // Menghitung relasi students
                                ->orderByDesc('students_count')
                                ->take(5) // Ambil 5 teratas
                                ->get();


        return view('course_admin.dashboard.index', compact(
            'stats',
            'popularCourses'
        ));
    }
}