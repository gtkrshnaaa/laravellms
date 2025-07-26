<?php

namespace App\Http\Controllers\CourseAdmin\CourseManagement;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Topic;
use Illuminate\Http\Request;

class CourseAdminManageCourseTopicController extends Controller
{
    public function create(Course $course)
    {
        return view('course_admin.dashboard.course_management.topics.create', compact('course'));
    }

    public function store(Request $request, Course $course)
    {
        $request->validate(['title' => 'required|string|max:255', 'order' => 'required|integer']);
        $topic = new Topic($request->all());
        $topic->course_id = $course->id;
        $topic->save();
        return redirect()->route('course_admin.management.courses.show', $course)->with('success', 'Topik berhasil ditambahkan.');
    }
    
    public function showMaterials(Topic $topic)
    {
        $topic->load(['videos', 'quizzes']);
        return view('course_admin.dashboard.course_management.materials.show', compact('topic'));
    }

    public function edit(Course $course, Topic $topic)
    {
        return view('course_admin.dashboard.course_management.topics.edit', compact('course', 'topic'));
    }

    public function update(Request $request, Course $course, Topic $topic)
    {
        $request->validate(['title' => 'required|string|max:255', 'order' => 'required|integer']);
        $topic->update($request->all());
        return redirect()->route('course_admin.management.courses.show', $course)->with('success', 'Topik berhasil diperbarui.');
    }

    public function destroy(Course $course, Topic $topic)
    {
        $topic->delete();
        return redirect()->route('course_admin.management.courses.show', $course)->with('success', 'Topik berhasil dihapus.');
    }
}