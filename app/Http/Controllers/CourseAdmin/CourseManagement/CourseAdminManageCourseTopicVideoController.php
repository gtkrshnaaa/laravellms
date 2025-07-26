<?php

namespace App\Http\Controllers\CourseAdmin\CourseManagement;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use App\Models\Video;
use Illuminate\Http\Request;

class CourseAdminManageCourseTopicVideoController extends Controller
{
    // Fungsi helper untuk mengonversi URL YouTube ke format embed
    private function convertToEmbedUrl($url)
    {
        // Contoh: https://www.youtube.com/watch?v=dQw4w9WgXcQ
        // Menjadi: https://www.youtube.com/embed/dQw4w9WgXcQ
        $pattern = '/(?:https?:\/\/)?(?:www\.)?(?:m\.)?(?:youtube\.com|youtu\.be)\/(?:watch\?v=|embed\/|v\/|)([\w-]{11})(?:\S+)?/';
        preg_match($pattern, $url, $matches);

        if (isset($matches[1])) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }

        // Jika URL sudah dalam format embed, kembalikan saja
        if (str_contains($url, 'youtube.com/embed/')) {
            return $url;
        }

        // Jika tidak cocok, kembalikan URL asli atau null, tergantung kebijakan.
        // Untuk saat ini, kembalikan URL asli, tapi validasi di request harus ketat.
        return $url;
    }

    public function create(Topic $topic)
    {
        return view('course_admin.dashboard.course_management.materials.videos.create', compact('topic'));
    }

    public function store(Request $request, Topic $topic)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'youtube_url' => 'required|url', // Tetap validasi sebagai URL
            'order' => 'required|integer',
        ]);

        // Convert YouTube URL to embed format
        $embedUrl = $this->convertToEmbedUrl($validatedData['youtube_url']);

        $video = new Video([
            'title' => $validatedData['title'],
            'youtube_url' => $embedUrl, // Simpan URL yang sudah diconvert
            'order' => $validatedData['order'],
        ]);
        $video->topic_id = $topic->id;
        $video->save();

        return redirect()->route('course_admin.management.topics.materials', $topic)->with('success', 'Video berhasil ditambahkan.');
    }

    public function edit(Topic $topic, Video $video)
    {
        return view('course_admin.dashboard.course_management.materials.videos.edit', compact('topic', 'video'));
    }

    public function update(Request $request, Topic $topic, Video $video)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'youtube_url' => 'required|url', // Tetap validasi sebagai URL
            'order' => 'required|integer',
        ]);

        // Convert YouTube URL to embed format
        $embedUrl = $this->convertToEmbedUrl($validatedData['youtube_url']);

        $video->title = $validatedData['title'];
        $video->youtube_url = $embedUrl; // Perbarui dengan URL yang sudah diconvert
        $video->order = $validatedData['order'];
        $video->save();

        return redirect()->route('course_admin.management.topics.materials', $topic)->with('success', 'Video berhasil diperbarui.');
    }

    public function destroy(Topic $topic, Video $video)
    {
        $video->delete();
        return redirect()->route('course_admin.management.topics.materials', $topic)->with('success', 'Video berhasil dihapus.');
    }
}