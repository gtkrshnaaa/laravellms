<?php

namespace App\Http\Controllers\PublicPage;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CourseSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicPageLandingPageController extends Controller
{
    /**
     * Menampilkan halaman landing utama dengan katalog kursus yang dinamis.
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
        $courses = $query->latest()->paginate(12)->withQueryString();

        return view('landingpage', compact('courses', 'categories', 'selectedCategory', 'selectedSubCategory', 'searchTerm'));
    }

    /**
     * Menampilkan halaman detail publik untuk satu kursus.
     */
    public function show(Course $course)
    {
        $course->load(['courseAdmin', 'lecturers', 'topics.videos', 'topics.quizzes', 'subCategory.category']);

        $isEnrolled = false;
        
        // Cek hanya jika ada siswa yang login
        if (Auth::guard('student')->check()) {
            $student = Auth::guard('student')->user();
            
            // Cek apakah sudah terdaftar
            $isEnrolled = $student->courses()->where('course_id', $course->id)->exists();
        }
        
        // Kirim semua variabel yang dibutuhkan ke view
        return view('course_detail', compact('course', 'isEnrolled'));
    }
}