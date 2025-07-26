<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LecturerDashboardController extends Controller
{
    public function index()
    {
        $lecturer = Auth::guard('lecturer')->user();
        
        // Ambil kursus yang diajar oleh dosen ini
        $courses = $lecturer->courses()->with('students')->get();

        // Hitung statistik
        $totalCourses = $courses->count();
        $totalStudents = $courses->pluck('students')->flatten()->unique('id')->count();

        // Ambil beberapa kursus terbaru sebagai shortcut
        $latestCourses = $lecturer->courses()->withCount('students')->latest()->take(3)->get();

        return view('lecturer.dashboard.index', compact('lecturer', 'totalCourses', 'totalStudents', 'latestCourses'));
    }
}