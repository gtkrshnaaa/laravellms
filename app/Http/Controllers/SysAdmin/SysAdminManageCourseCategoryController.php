<?php

namespace App\Http\Controllers\SysAdmin;

use App\Http\Controllers\Controller;
use App\Models\CourseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SysAdminManageCourseCategoryController extends Controller
{
    public function index()
    {
        $categories = CourseCategory::withCount('subCategories')->latest()->paginate(10);
        return view('sysadmin.dashboard.course_category_management.index', compact('categories'));
    }

    public function create()
    {
        return view('sysadmin.dashboard.course_category_management.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255|unique:course_categories']);
        CourseCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);
        return redirect()->route('sysadmin.manage-categories.index')->with('success', 'Kategori baru berhasil dibuat.');
    }

    public function edit(CourseCategory $category)
    {
        return view('sysadmin.dashboard.course_category_management.edit', compact('category'));
    }

    public function update(Request $request, CourseCategory $category)
    {
        $request->validate(['name' => 'required|string|max:255|unique:course_categories,name,' . $category->id]);
        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);
        return redirect()->route('sysadmin.manage-categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(CourseCategory $category)
    {
        $category->delete();
        return redirect()->route('sysadmin.manage-categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}