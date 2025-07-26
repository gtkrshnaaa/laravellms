<?php

namespace App\Http\Controllers\CourseAdmin\CourseManagement;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lecturer;
use Illuminate\Http\Request;

class CourseAdminManageCourseLecturerController extends Controller
{
    /**
     * Menampilkan halaman untuk memilih dosen.
     */
    public function index(Course $course)
    {
        // Ambil semua dosen yang tersedia, diurutkan berdasarkan nama.
        $lecturers = Lecturer::orderBy('name')->get();
        
        // Ambil ID dari dosen yang sudah ditugaskan ke kursus ini untuk menandai checkbox.
        // Sebutkan nama tabel secara eksplisit untuk kolom 'id'
        $assignedLecturerIds = $course->lecturers()->pluck('lecturers.id')->toArray();
        
        return view('course_admin.dashboard.course_management.lecturers.index', compact('course', 'lecturers', 'assignedLecturerIds'));
    }

    /**
     * Menyimpan hasil penugasan dosen.
     */
    public function store(Request $request, Course $course)
    {
        $request->validate([
            'lecturers' => 'nullable|array',
            'lecturers.*' => 'exists:lecturers,id' // Validasi untuk memastikan semua ID yang dikirim valid.
        ]);

        // Menggunakan sync() adalah cara paling efisien untuk me-manage relasi many-to-many.
        // Laravel akan secara otomatis menambah (attach) dan menghapus (detach) relasi berdasarkan
        // array ID yang kita berikan.
        $course->lecturers()->sync($request->input('lecturers', []));

        return redirect()->route('course_admin.management.courses.show', $course)
                         ->with('success', 'Dosen untuk kursus ini berhasil diperbarui.');
    }
}