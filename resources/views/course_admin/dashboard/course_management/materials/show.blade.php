@extends('layouts.course_admin')
@section('title', 'Kelola Materi: ' . $topic->title)

@section('content')
<a href="{{ route('course_admin.management.courses.show', $topic->course) }}" class="text-sm text-secondary hover:text-primary mb-4 inline-block transition duration-200">
    < Kembali ke Kelola Kursus
</a>

<h1 class="text-2xl font-bold text-primary mb-4">Kelola Materi untuk Topik: "{{ $topic->title }}"</h1>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    {{-- Video Section --}}
    <div class="bg-surface p-6 rounded-lg border-2 border-border">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-primary">Materi Video</h2>
            <a href="{{ route('course_admin.management.topics.videos.create', $topic) }}" class="bg-primary hover:bg-primary/90 text-background px-3 py-1 rounded-md text-sm font-semibold inline-flex items-center transition duration-300">
                {{-- Unicons Plus --}}
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Video
            </a>
        </div>
        <div class="divide-y divide-border">
            @forelse ($topic->videos as $video)
                <div class="py-3">
                    <div class="flex justify-between items-center mb-2">
                        <p class="text-primary text-lg"><span class="font-bold">{{ $video->order }}.</span> {{ $video->title }}</p>
                        <div class="space-x-2 whitespace-nowrap">
                            <a href="{{ route('course_admin.management.topics.videos.edit', [$topic, $video]) }}" class="text-blue-600 hover:text-blue-800 font-semibold text-sm transition duration-200">Edit</a>
                            <form action="{{ route('course_admin.management.topics.videos.destroy', [$topic, $video]) }}" method="POST" class="inline" onsubmit="return confirm('Hapus video ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-gray-600 hover:text-gray-800 font-semibold text-sm transition duration-200">Hapus</button>
                            </form>
                        </div>
                    </div>
                    {{-- Tambahkan iframe untuk memutar video --}}
                    @if ($video->youtube_url)
                        <div class="aspect-w-16 aspect-h-9 relative" style="padding-top: 56.25%;"> {{-- Ini untuk aspect ratio 16:9 --}}
                            <iframe
                                class="absolute top-0 left-0 w-full h-full rounded-lg shadow-inner"
                                src="{{ $video->youtube_url }}"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen
                            ></iframe>
                        </div>
                    @else
                        <p class="text-secondary text-sm mt-1">URL video tidak tersedia atau tidak valid.</p>
                    @endif
                </div>
            @empty
                <p class="text-secondary text-center py-4">Belum ada video.</p>
            @endforelse
        </div>
    </div>

    {{-- Quiz Section --}}
    <div class="bg-surface p-6 rounded-lg border-2 border-border">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-primary">Materi Kuis</h2>
            <a href="{{ route('course_admin.management.topics.quizzes.create', $topic) }}" class="bg-primary hover:bg-primary/90 text-background px-3 py-1 rounded-md text-sm font-semibold inline-flex items-center transition duration-300">
                {{-- Unicons Plus --}}
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Kuis
            </a>
        </div>
        <div class="divide-y divide-border">
            @forelse ($topic->quizzes as $quiz)
                <div class="flex justify-between items-center py-3">
                    <p class="text-primary"><span class="font-bold">{{ $quiz->order }}.</span> {{ $quiz->title }}</p>
                    <div class="space-x-2 whitespace-nowrap">
                        <a href="{{ route('course_admin.management.quizzes.questions.index', $quiz) }}" class="text-green-600 hover:text-green-800 font-semibold text-sm transition duration-200">Soal</a>
                        <a href="{{ route('course_admin.management.topics.quizzes.edit', [$topic, $quiz]) }}" class="text-blue-600 hover:text-blue-800 font-semibold text-sm transition duration-200">Edit</a>
                        <form action="{{ route('course_admin.management.topics.quizzes.destroy', [$topic, $quiz]) }}" method="POST" class="inline" onsubmit="return confirm('Hapus kuis ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-gray-600 hover:text-gray-800 font-semibold text-sm transition duration-200">Hapus</button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-secondary text-center py-4">Belum ada kuis.</p>
            @endforelse
        </div>
    </div>

    {{-- Google Drive Section --}}
    <div class="bg-surface p-6 rounded-lg border border-border mt-8">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-primary">Materi Google Drive</h2>
            <a href="{{ route('course_admin.management.topics.googledrive.create', $topic) }}" class="bg-primary hover:bg-primary/90 text-background px-3 py-1 rounded-md text-sm font-semibold inline-flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg> Tambah Materi Drive
            </a>
        </div>
        <div class="divide-y divide-border">
            @forelse ($topic->googleDriveMaterials as $material)
                <div class="flex justify-between items-center py-3">
                    <p class="text-primary"><span class="font-bold">{{ $material->order }}.</span> {{ $material->title }}</p>
                    <div class="space-x-2 whitespace-nowrap">
                        <a href="{{ route('course_admin.management.topics.googledrive.edit', [$topic, $material]) }}" class="text-blue-600 hover:text-blue-800 font-semibold text-sm">Edit</a>
                        <form action="{{ route('course_admin.management.topics.googledrive.destroy', [$topic, $material]) }}" method="POST" class="inline" onsubmit="return confirm('Hapus materi ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-gray-600 hover:text-gray-800 font-semibold text-sm">Hapus</button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-secondary text-center py-4">Belum ada materi Google Drive.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection