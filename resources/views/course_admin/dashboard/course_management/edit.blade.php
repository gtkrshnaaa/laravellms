@extends('layouts.course_admin')
@section('title', 'Edit Kursus')

@section('content')
<a href="{{ route('course_admin.management.courses.index') }}" class="text-sm text-main-red hover:underline mb-4 inline-block transition duration-200">
    < Kembali ke Daftar Kursus
</a>
<h1 class="text-2xl font-bold text-dark-text mb-6">Edit Kursus: {{ $course->name }}</h1>
<div class="bg-white p-6 rounded-lg border-2 border-gray-100">
    <form action="{{ route('course_admin.management.courses.update', $course) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="name" class="block text-dark-text font-medium mb-2">Nama Kursus</label>
            <input type="text" name="name" id="name" class="w-full border border-gray-300 px-3 py-2 rounded-md shadow-sm focus:border-main-red focus:ring-main-red @error('name') border-gray-500 @enderror" value="{{ old('name', $course->name ?? '') }}" required>
            @error('name') <p class="text-gray-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- === PILIHAN KATEGORI === --}}
        <div class="mb-4">
            <label for="course_sub_category_id" class="block text-dark-text font-medium mb-2">Kategori Kursus (Opsional)</label>
            <select name="course_sub_category_id" id="course_sub_category_id" class="w-full border border-gray-300 px-3 py-2 rounded-md shadow-sm focus:border-main-red focus:ring-main-red">
                <option value="">-- Tidak ada kategori --</option>
                @foreach ($categories as $category)
                    <optgroup label="{{ $category->name }}">
                        @foreach ($category->subCategories as $subCategory)
                            <option value="{{ $subCategory->id }}" {{ old('course_sub_category_id', $course->course_sub_category_id) == $subCategory->id ? 'selected' : '' }}>
                                {{ $subCategory->name }}
                            </option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select>
            @error('course_sub_category_id') <p class="text-gray-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="thumbnail" class="block text-dark-text font-medium mb-2">Thumbnail</label>
            @if($course->thumbnail)
                <img src="{{ Storage::url($course->thumbnail) }}" alt="{{ $course->name }}" class="w-48 h-auto rounded-md mb-2 object-cover">
            @endif
            <input type="file" name="thumbnail" id="thumbnail" class="w-full border border-gray-300 px-3 py-2 rounded-md shadow-sm focus:border-main-red focus:ring-main-red file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-light-red file:text-main-red hover:file:bg-gray-100 @error('thumbnail') border-gray-500 @enderror">
            <small class="text-light-text">Kosongkan jika tidak ingin mengubah thumbnail. Max 2MB.</small>
            @error('thumbnail') <p class="text-gray-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>
        <div class="mb-6">
            <label for="description" class="block text-dark-text font-medium mb-2">Deskripsi</label>
            <textarea name="description" id="description" rows="4" class="w-full border border-gray-300 px-3 py-2 rounded-md shadow-sm focus:border-main-red focus:ring-main-red @error('description') border-gray-500 @enderror" required>{{ old('description', $course->description ?? '') }}</textarea>
            @error('description') <p class="text-gray-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>
        
        <div class="flex items-center">
            <button type="submit" class="bg-main-red hover:bg-dark-red text-white font-bold py-2 px-4 rounded-md transition duration-300">Simpan Kursus</button>
            <a href="{{ route('course_admin.management.courses.index') }}" class="ml-4 text-light-text hover:text-dark-text transition duration-200">Batal</a>
        </div>
    </form>
</div>
@endsection