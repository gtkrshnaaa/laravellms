<?php

namespace App\Http\Controllers\SysAdmin;

use App\Http\Controllers\Controller;
use App\Models\CourseCategory;
use App\Models\CourseSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SysAdminManageCourseSubCategoryController extends Controller
{
    // Ini adalah halaman "Manage"
    public function index(CourseCategory $category)
    {
        $subCategories = $category->subCategories()->paginate(10);
        return view('sysadmin.dashboard.course_category_management.course_sub_category_management.index', compact('category', 'subCategories'));
    }

    // Proses 'store' terjadi di halaman yang sama
    public function store(Request $request, CourseCategory $category)
    {
        $request->validate(['name' => 'required|string|max:255']);
        
        $category->subCategories()->create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return redirect()->route('sysadmin.manage-sub-categories.index', $category)->with('success', 'Sub-kategori berhasil ditambahkan.');
    }
    
    // Fungsi edit dan update untuk sub-kategori
    public function edit(CourseSubCategory $subCategory)
    {
        return view('sysadmin.dashboard.course_category_management.course_sub_category_management.edit', compact('subCategory'));
    }

    public function update(Request $request, CourseSubCategory $subCategory)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $subCategory->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return redirect()->route('sysadmin.manage-sub-categories.index', $subCategory->course_category_id)->with('success', 'Sub-kategori berhasil diperbarui.');
    }


    // Fungsi hapus untuk sub-kategori
    public function destroy(CourseSubCategory $subCategory)
    {
        $categoryId = $subCategory->course_category_id;
        $subCategory->delete();
        return redirect()->route('sysadmin.manage-sub-categories.index', $categoryId)->with('success', 'Sub-kategori berhasil dihapus.');
    }
}