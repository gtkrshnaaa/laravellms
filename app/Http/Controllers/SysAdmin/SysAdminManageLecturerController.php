<?php

namespace App\Http\Controllers\SysAdmin;

use App\Http\Controllers\Controller;
use App\Models\Lecturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SysAdminManageLecturerController extends Controller
{
    public function index()
    {
        $lecturers = Lecturer::latest()->paginate(10);
        return view('sysadmin.dashboard.lecturer_management.index', compact('lecturers'));
    }

    public function create()
    {
        return view('sysadmin.dashboard.lecturer_management.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:lecturers,email',
            'password' => 'required|min:6|confirmed',
        ]);

        Lecturer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('sysadmin.manage_lecturer.index')->with('success', 'Lecturer berhasil ditambahkan.');
    }

    public function edit(Lecturer $lecturer)
    {
        return view('sysadmin.dashboard.lecturer_management.edit', compact('lecturer'));
    }

    public function update(Request $request, Lecturer $lecturer)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:lecturers,email,' . $lecturer->id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        $lecturer->name = $request->name;
        $lecturer->email = $request->email;

        if ($request->filled('password')) {
            $lecturer->password = Hash::make($request->password);
        }

        $lecturer->save();

        return redirect()->route('sysadmin.manage_lecturer.index')->with('success', 'Lecturer berhasil diperbarui.');
    }

    public function destroy(Lecturer $lecturer)
    {
        $lecturer->delete();
        return redirect()->route('sysadmin.manage_lecturer.index')->with('success', 'Lecturer berhasil dihapus.');
    }
}