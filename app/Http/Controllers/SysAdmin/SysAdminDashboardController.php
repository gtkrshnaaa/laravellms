<?php

namespace App\Http\Controllers\SysAdmin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseAdmin;
use App\Models\Lecturer;
use App\Models\Student;
use App\Models\SysAdmin;
use Illuminate\Http\Request;

class SysAdminDashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard sysadmin dengan data statistik lengkap.
     */
    public function index()
    {
        // --- Statistik Pengguna ---
        $userStats = [
            'students' => Student::count(),
            'lecturers' => Lecturer::count(),
            'course_admins' => CourseAdmin::count(),
            'sysadmins' => SysAdmin::count(),
        ];

        // --- Statistik Konten ---
        $contentStats = [
            'courses' => Course::count(),
        ];
        
        // --- Data Aktivitas Terbaru ---
        $recentActivities = [
            'latest_students' => Student::latest()->take(5)->get(),
        ];

        return view('sysadmin.dashboard.index', compact(
            'userStats',
            'contentStats',
            'recentActivities'
        ));
    }
}