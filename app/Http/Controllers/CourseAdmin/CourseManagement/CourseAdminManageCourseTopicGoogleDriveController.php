<?php

namespace App\Http\Controllers\CourseAdmin\CourseManagement;

use App\Http\Controllers\Controller;
use App\Models\GoogleDriveMaterial;
use App\Models\Topic;
use Illuminate\Http\Request;

class CourseAdminManageCourseTopicGoogleDriveController extends Controller
{
    public function create(Topic $topic)
    {
        return view('course_admin.dashboard.course_management.materials.google_drive.create', compact('topic'));
    }

    public function store(Request $request, Topic $topic)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'google_drive_url' => 'required|url',
            'description' => 'nullable|string',
            'order' => 'required|integer',
        ]);

        $topic->googleDriveMaterials()->create($validated);

        return redirect()->route('course_admin.management.topics.materials', $topic)->with('success', 'Materi Google Drive berhasil ditambahkan.');
    }

    public function edit(Topic $topic, GoogleDriveMaterial $googleDriveMaterial)
    {
        return view('course_admin.dashboard.course_management.materials.google_drive.edit', compact('topic', 'googleDriveMaterial'));
    }

    public function update(Request $request, Topic $topic, GoogleDriveMaterial $googleDriveMaterial)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'google_drive_url' => 'required|url',
            'description' => 'nullable|string',
            'order' => 'required|integer',
        ]);

        $googleDriveMaterial->update($validated);

        return redirect()->route('course_admin.management.topics.materials', $topic)->with('success', 'Materi Google Drive berhasil diperbarui.');
    }

    public function destroy(Topic $topic, GoogleDriveMaterial $googleDriveMaterial)
    {
        $googleDriveMaterial->delete();
        return redirect()->route('course_admin.management.topics.materials', $topic)->with('success', 'Materi Google Drive berhasil dihapus.');
    }
}