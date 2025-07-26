<?php

namespace App\Http\Controllers\CourseAdmin\CourseManagement;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\Topic;
use Illuminate\Http\Request;

class CourseAdminManageCourseTopicQuizController extends Controller
{
    public function create(Topic $topic)
    {
        return view('course_admin.dashboard.course_management.materials.quizzes.create', compact('topic'));
    }

    public function store(Request $request, Topic $topic)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'min_score' => 'required|integer|min:0|max:100',
            'order' => 'required|integer',
        ]);
        $quiz = new Quiz($request->all());
        $quiz->topic_id = $topic->id;
        $quiz->save();
        return redirect()->route('course_admin.management.topics.materials', $topic)->with('success', 'Kuis berhasil ditambahkan.');
    }

    public function edit(Topic $topic, Quiz $quiz)
    {
        return view('course_admin.dashboard.course_management.materials.quizzes.edit', compact('topic', 'quiz'));
    }

    public function update(Request $request, Topic $topic, Quiz $quiz)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'min_score' => 'required|integer|min:0|max:100',
            'order' => 'required|integer',
        ]);
        $quiz->update($request->all());
        return redirect()->route('course_admin.management.topics.materials', $topic)->with('success', 'Kuis berhasil diperbarui.');
    }

    public function destroy(Topic $topic, Quiz $quiz)
    {
        $quiz->delete();
        return redirect()->route('course_admin.management.topics.materials', $topic)->with('success', 'Kuis berhasil dihapus.');
    }
}