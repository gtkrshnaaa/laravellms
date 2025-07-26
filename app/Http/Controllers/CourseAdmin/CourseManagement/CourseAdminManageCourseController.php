<?php

namespace App\Http\Controllers\CourseAdmin\CourseManagement;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CourseAdminManageCourseController extends Controller
{
    private function authorizeAccess(Course $course)
    {
        if ($course->course_admin_id !== Auth::guard('course_admin')->id()) {
            abort(403, 'Akses ditolak.');
        }
    }

    public function index()
    {
        $courses = Course::where('course_admin_id', Auth::guard('course_admin')->id())
            // Tambahkan eager loading untuk relasi subCategory dan category-nya
            ->with(['subCategory.category', 'topics'])
            ->withCount('topics')
            ->latest()
            ->paginate(10);
            
        return view('course_admin.dashboard.course_management.index', compact('courses'));
    }

    public function create()
    {
        // Ambil semua kategori beserta sub-kategorinya
        $categories = CourseCategory::with('subCategories')->orderBy('name')->get();
        return view('course_admin.dashboard.course_management.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'course_sub_category_id' => 'nullable|exists:course_sub_categories,id',
        ]);

        $data = $request->only('name', 'description', 'course_sub_category_id');
        $data['course_admin_id'] = Auth::guard('course_admin')->id();

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('thumbnails', 'public');
            $data['thumbnail'] = $path;
        }

        Course::create($data);

        return redirect()->route('course_admin.management.courses.index')->with('success', 'Kursus berhasil dibuat.');
    }

    public function show(Course $course)
    {
        $this->authorizeAccess($course);
        // Tambahkan juga eager loading di sini
        $course->load('topics', 'lecturers', 'subCategory.category');
        return view('course_admin.dashboard.course_management.show', compact('course'));
    }

    public function edit(Course $course)
    {
        $this->authorizeAccess($course);
        // Ambil semua kategori untuk dropdown di form edit
        $categories = CourseCategory::with('subCategories')->orderBy('name')->get();
        return view('course_admin.dashboard.course_management.edit', compact('course', 'categories'));
    }

    public function update(Request $request, Course $course)
    {
        $this->authorizeAccess($course);
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'course_sub_category_id' => 'nullable|exists:course_sub_categories,id',
        ]);

        $data = $request->only('name', 'description', 'course_sub_category_id');
        
        if ($request->hasFile('thumbnail')) {
            if ($course->thumbnail) {
                Storage::disk('public')->delete($course->thumbnail);
            }
            $path = $request->file('thumbnail')->store('thumbnails', 'public');
            $data['thumbnail'] = $path;
        }

        $course->update($data);

        return redirect()->route('course_admin.management.courses.index')->with('success', 'Kursus berhasil diperbarui.');
    }



    public function destroy(Course $course)
    {
        $this->authorizeAccess($course);

        // Hapus thumbnail dari storage saat kursus dihapus
        if ($course->thumbnail) {
            Storage::disk('public')->delete($course->thumbnail);
        }

        $course->delete();
        return redirect()->route('course_admin.management.courses.index')->with('success', 'Kursus berhasil dihapus.');
    }
}