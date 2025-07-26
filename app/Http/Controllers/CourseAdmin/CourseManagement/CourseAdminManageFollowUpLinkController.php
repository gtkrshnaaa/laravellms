<?php

namespace App\Http\Controllers\CourseAdmin\CourseManagement;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseFollowUpLink;
use Illuminate\Http\Request;

class CourseAdminManageFollowUpLinkController extends Controller
{
    public function store(Request $request, Course $course)
    {
        $request->validate([
            'label' => 'required|string|max:255',
            'url' => 'required|url',
        ]);

        $course->followUpLinks()->create($request->all());

        return back()->with('success', 'Tautan follow up berhasil ditambahkan.');
    }

    public function destroy(CourseFollowUpLink $link)
    {
        // Otorisasi sederhana untuk memastikan admin yang benar yang menghapus
        if ($link->course->course_admin_id !== auth('course_admin')->id()) {
            abort(403);
        }

        $link->delete();

        return back()->with('success', 'Tautan follow up berhasil dihapus.');
    }
}