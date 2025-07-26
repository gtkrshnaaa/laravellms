<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LecturerCourseController extends Controller
{
    /**
     * Menampilkan daftar kursus yang diampu oleh dosen.
     */
    public function index()
    {
        $lecturer = Auth::guard('lecturer')->user();
        $courses = $lecturer->courses()->withCount('students')->latest()->paginate(9);

        return view('lecturer.dashboard.courses.index', compact('courses'));
    }

    /**
     * Menampilkan detail kursus, termasuk daftar siswa dan progres mereka.
     */
    public function show(Course $course)
    {
        // Autorisasi: pastikan dosen ini memang mengajar kursus yang diminta
        $this->authorizeAccess($course);

        // Ambil siswa yang terdaftar, lalu inject progres mereka
        $students = $course->students()->get()->map(function ($student) use ($course) {
            $student->progress = $course->getProgressPercentageForStudent($student);
            return $student;
        });

        return view('lecturer.dashboard.courses.show', compact('course', 'students'));
    }

    /**
     * Helper untuk memastikan dosen hanya bisa mengakses kursus yang dia ampu.
     */
    private function authorizeAccess(Course $course)
    {
        $lecturerId = Auth::guard('lecturer')->id();
        if (!$course->lecturers()->where('lecturers.id', $lecturerId)->exists()) {
            abort(403, 'AKSES DITOLAK. ANDA BUKAN PENGAJAR DI KURSUS INI.');
        }
    }
}