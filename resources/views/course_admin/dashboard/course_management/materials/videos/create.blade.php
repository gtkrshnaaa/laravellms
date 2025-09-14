@extends('layouts.course_admin')
@section('title', 'Tambah Video')
@section('content')
    <a href="{{ route('course_admin.management.topics.materials', $topic) }}" class="text-sm text-blue-600 hover:underline mb-4 inline-block transition duration-200">
        < Kembali ke Kelola Materi
    </a>
    <h1 class="text-2xl font-bold text-black mb-4">Tambah Video untuk Topik: {{ $topic->title }}</h1>
    <div class="bg-white p-6 rounded-lg border border-blue-100">
        <form action="{{ route('course_admin.management.topics.videos.store', $topic) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-black font-medium mb-2">Judul Video</label>
                <input type="text" name="title" id="title" class="w-full border border-blue-100 px-3 py-2 rounded-md shadow-sm focus:border-blue-500 @error('title') border-blue-500 @enderror" value="{{ old('title') }}" required>
                @error('title') <p class="text-gray-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="mb-4">
                <label for="youtube_url" class="block text-black font-medium mb-2">URL YouTube</label>
                <input type="url" name="youtube_url" id="youtube_url" class="w-full border border-blue-100 px-3 py-2 rounded-md shadow-sm focus:border-blue-500 @error('youtube_url') border-blue-500 @enderror" value="{{ old('youtube_url') }}" required>
                @error('youtube_url') <p class="text-gray-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="mb-6">
                <label for="order" class="block text-black font-medium mb-2">Urutan</label>
                <input type="number" name="order" id="order" class="w-full border border-blue-100 px-3 py-2 rounded-md shadow-sm focus:border-blue-500 @error('order') border-blue-500 @enderror" value="{{ old('order', '0') }}" required>
                @error('order') <p class="text-gray-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="flex items-center">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md transition duration-300">Simpan Video</button>
                <a href="{{ route('course_admin.management.topics.materials', $topic) }}" class="ml-4 text-gray-600 hover:text-black transition duration-200">Batal</a>
            </div>
        </form>
    </div>
@endsection