@extends('layouts.course_admin')
@section('title', 'Tambah Topik Baru')

@section('content')
<a href="{{ route('course_admin.management.courses.show', $course) }}" class="text-sm text-main-red hover:underline mb-4 inline-block transition duration-200">
    < Kembali ke Kelola Kursus
</a>
<h1 class="text-2xl font-bold text-dark-text mb-6">Tambah Topik untuk Kursus: {{ $course->name }}</h1>
<div class="bg-white p-6 rounded-lg border-2 border-gray-100">
    <form action="{{ route('course_admin.management.courses.topics.store', $course) }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="title" class="block text-dark-text font-medium mb-2">Judul Topik</label>
            <input type="text" name="title" id="title" class="w-full border border-gray-300 px-3 py-2 rounded-md shadow-sm focus:border-main-red focus:ring-main-red @error('title') border-gray-500 @enderror" value="{{ old('title') }}" required>
            @error('title') <p class="text-gray-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>
        <div class="mb-6">
            <label for="order" class="block text-dark-text font-medium mb-2">Urutan</label>
            <input type="number" name="order" id="order" class="w-full border border-gray-300 px-3 py-2 rounded-md shadow-sm focus:border-main-red focus:ring-main-red @error('order') border-gray-500 @enderror" value="{{ old('order', '0') }}" required>
            @error('order') <p class="text-gray-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>
        <div class="flex items-center">
            <button type="submit" class="bg-main-red hover:bg-dark-red text-white font-bold py-2 px-4 rounded-md transition duration-300">Simpan Topik</button>
            <a href="{{ route('course_admin.management.courses.show', $course) }}" class="ml-4 text-light-text hover:text-dark-text transition duration-200">Batal</a>
        </div>
    </form>
</div>
@endsection