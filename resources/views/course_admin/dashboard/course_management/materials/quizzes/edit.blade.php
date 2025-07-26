@extends('layouts.course_admin')
@section('title', 'Edit Kuis')
@section('content')
    <a href="{{ route('course_admin.management.topics.materials', $topic) }}" class="text-sm text-main-red hover:underline mb-4 inline-block transition duration-200">
        < Kembali ke Kelola Materi
    </a>
    <h1 class="text-2xl font-bold text-dark-text mb-4">Edit Kuis: {{ $quiz->title }}</h1>
    <div class="bg-white p-6 rounded-lg border-2 border-gray-100">
        <form action="{{ route('course_admin.management.topics.quizzes.update', [$topic, $quiz]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="title" class="block text-dark-text font-medium mb-2">Judul Kuis</label>
                <input type="text" name="title" id="title" class="w-full border border-gray-300 px-3 py-2 rounded-md shadow-sm focus:border-main-red focus:ring-main-red @error('title') border-gray-500 @enderror" value="{{ old('title', $quiz->title ?? '') }}" required>
                @error('title') <p class="text-gray-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="mb-4">
                <label for="description" class="block text-dark-text font-medium mb-2">Deskripsi</label>
                <textarea name="description" id="description" rows="3" class="w-full border border-gray-300 px-3 py-2 rounded-md shadow-sm focus:border-main-red focus:ring-main-red @error('description') border-gray-500 @enderror">{{ old('description', $quiz->description ?? '') }}</textarea>
                @error('description') <p class="text-gray-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <label for="min_score" class="block text-dark-text font-medium mb-2">Skor Minimum Lulus</label>
                    <input type="number" name="min_score" id="min_score" class="w-full border border-gray-300 px-3 py-2 rounded-md shadow-sm focus:border-main-red focus:ring-main-red @error('min_score') border-gray-500 @enderror" value="{{ old('min_score', $quiz->min_score ?? '70') }}" required>
                    @error('min_score') <p class="text-gray-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="order" class="block text-dark-text font-medium mb-2">Urutan</label>
                    <input type="number" name="order" id="order" class="w-full border border-gray-300 px-3 py-2 rounded-md shadow-sm focus:border-main-red focus:ring-main-red @error('order') border-gray-500 @enderror" value="{{ old('order', $quiz->order ?? '0') }}" required>
                    @error('order') <p class="text-gray-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
            <div class="flex items-center">
                <button type="submit" class="bg-main-red hover:bg-dark-red text-white font-bold py-2 px-4 rounded-md transition duration-300">Simpan Kuis</button>
                <a href="{{ route('course_admin.management.topics.materials', $topic) }}" class="ml-4 text-light-text hover:text-dark-text transition duration-200">Batal</a>
            </div>
        </form>
    </div>
@endsection