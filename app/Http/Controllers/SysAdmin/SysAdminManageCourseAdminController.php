<?php

namespace App\Http\Controllers\SysAdmin;

use App\Http\Controllers\Controller;
use App\Models\CourseAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SysAdminManageCourseAdminController extends Controller
{
    // Hanya superadmin yang boleh akses
    // public function __construct()
    // {
    //     $this->middleware(function ($request, $next) {
    //         if (auth('sysadmin')->user()->level !== 'superadmin') {
    //             abort(403, 'Hanya superadmin yang boleh mengakses halaman ini.');
    //         }
    //         return $next($request);
    //     });
    // }

    public function index()
    {
        $course_admins = CourseAdmin::latest()->paginate(10);
        return view('sysadmin.dashboard.course_admin_management.index', compact('course_admins'));
    }

    public function create()
    {
        return view('sysadmin.dashboard.course_admin_management.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:course_admins,email',
            'password' => 'required|min:6|confirmed',
        ]);

        CourseAdmin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('sysadmin.manage_course_admin.index')->with('success', 'Course Admin berhasil ditambahkan.');
    }

    public function edit(CourseAdmin $courseAdmin)
    {
        return view('sysadmin.dashboard.course_admin_management.edit', compact('courseAdmin'));
    }

    public function update(Request $request, CourseAdmin $courseAdmin)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:course_admins,email,' . $courseAdmin->id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        $courseAdmin->name = $request->name;
        $courseAdmin->email = $request->email;

        if ($request->filled('password')) {
            $courseAdmin->password = Hash::make($request->password);
        }

        $courseAdmin->save();

        return redirect()->route('sysadmin.manage_course_admin.index')->with('success', 'Course Admin berhasil diperbarui.');
    }

    public function destroy(CourseAdmin $courseAdmin)
    {
        $courseAdmin->delete();
        return redirect()->route('sysadmin.manage_course_admin.index')->with('success', 'Course Admin berhasil dihapus.');
    }
}