<?php

namespace App\Http\Controllers\CourseAdmin\CourseManagement;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseAdminBatchEnrollmentController extends Controller
{
    /**
     * Show the form for creating a new batch enrollment.
     */
    public function create()
    {
        $courseAdminId = Auth::guard('course_admin')->id();
        
        // Get courses managed by this admin
        $courses = Course::where('course_admin_id', $courseAdminId)->get();
        
        // Get distinct divisions from students table
        $divisions = Student::whereNotNull('division')
            ->distinct()
            ->orderBy('division')
            ->pluck('division');

        return view('course_admin.batch_enrollment.create', compact('courses', 'divisions'));
    }

    /**
     * Store a newly created batch enrollment.
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'division' => 'required|string',
        ]);

        $course = Course::findOrFail($request->course_id);
        
        // Ensure the course belongs to the authenticated admin
        if ($course->course_admin_id !== Auth::guard('course_admin')->id()) {
            abort(403);
        }

        $students = Student::where('division', $request->division)->get();
        $count = 0;

        foreach ($students as $student) {
            // Check if already enrolled to avoid duplicates or errors (syncWithoutDetaching is safer but attach is fine if checked)
            if (!$student->courses()->where('course_id', $course->id)->exists()) {
                $student->courses()->attach($course->id);
                $count++;
            }
        }

        return redirect()->route('course_admin.management.courses.index')
            ->with('success', "Berhasil mendaftarkan $count siswa dari divisi {$request->division} ke kursus {$course->name}.");
    }
}
