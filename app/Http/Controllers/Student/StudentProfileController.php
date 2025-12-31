<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentProfileController extends Controller
{
    public function edit()
    {
        $student = Auth::guard('student')->user();
        return view('student.dashboard.profile.edit', compact('student'));
    }

    public function update(Request $request)
    {
        $student = Auth::guard('student')->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:students,email,' . $student->id,
            'division' => 'nullable|string|in:IT,Marketing,HR,Finance,Operations',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $student->name = $request->name;
        $student->email = $request->email;
        $student->division = $request->division;
        if ($request->filled('password')) {
            $student->password = Hash::make($request->password);
        }
        $student->save();

        return redirect()->route('student.profile.edit')->with('success', 'Profil berhasil diperbarui.');
    }
}