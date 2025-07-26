<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CourseSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentCourseController extends Controller
{
    /**
     * Menampilkan semua kursus yang tersedia (katalog) dengan filter kategori.
     */
    public function index(Request $request)
    {
        // 1. Ambil semua kategori untuk ditampilkan sebagai tab
        $categories = CourseCategory::with('subCategories')->orderBy('name')->get();

        // 2. Ambil slug kategori & sub-kategori yang dipilih dari URL
        $selectedCategorySlug = $request->query('category');
        $selectedSubCategorySlug = $request->query('subcategory');
        
        // --- Ambil kata kunci pencarian ---
        $searchTerm = $request->query('search');

        // 3. Siapkan query dasar untuk mengambil kursus
        $query = Course::query()->with(['courseAdmin', 'subCategory.category']);

        $selectedCategory = null;
        $selectedSubCategory = null;

        // 4. Terapkan filter berdasarkan slug
        if ($selectedCategorySlug) {
            $selectedCategory = CourseCategory::where('slug', $selectedCategorySlug)->firstOrFail();
            
            if ($selectedSubCategorySlug) {
                $selectedSubCategory = CourseSubCategory::where('slug', $selectedSubCategorySlug)
                                                        ->where('course_category_id', $selectedCategory->id)
                                                        ->firstOrFail();
                $query->where('course_sub_category_id', $selectedSubCategory->id);
            } else {
                $query->whereIn('course_sub_category_id', $selectedCategory->subCategories->pluck('id'));
            }
        }

        // --- Terapkan filter pencarian jika ada ---
        if ($searchTerm) {
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $searchTerm . '%');
            });
        }

        // 5. Ambil data kursus yang sudah difilter
        $courses = $query->latest()->paginate(9)->withQueryString();
        
        // Ambil ID kursus yang sudah di-enroll oleh siswa yang login
        $enrolledCourseIds = Auth::guard('student')->user()->courses()->pluck('courses.id')->toArray();

        return view('student.dashboard.courses.index', compact(
            'courses', 
            'enrolledCourseIds', 
            'categories', 
            'selectedCategory', 
            'selectedSubCategory',
            'searchTerm'
        ));
    }

    /**
     * Menampilkan detail satu kursus sebelum di-enroll.
     */
    public function show(Course $course)
    {
        $course->load(['courseAdmin', 'topics', 'lecturers', 'subCategory.category']);
        $student = Auth::guard('student')->user();

        // Cek apakah siswa sudah terdaftar
        $isEnrolled = $student->courses()->where('course_id', $course->id)->exists();
        
        return view('student.dashboard.courses.show', compact('course', 'isEnrolled'));
    }

    /**
     * Mendaftarkan siswa ke kursus (gratis).
     */
    public function enroll(Course $course)
    {
        $student = Auth::guard('student')->user();

        // Cek apakah sudah terdaftar untuk menghindari duplikasi
        if ($student->courses()->where('course_id', $course->id)->exists()) {
            return redirect()->route('student.enrolled_course.show', $course)->with('info', 'Anda sudah terdaftar di kursus ini.');
        }

        // Daftarkan siswa ke kursus
        $student->courses()->syncWithoutDetaching($course->id);

        return redirect()->route('student.enrolled_course.show', $course)->with('success', 'Selamat! Anda berhasil mendaftar di kursus ini.');
    }
}