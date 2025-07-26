@extends('layouts.sysadmin')
@section('title', 'Edit Sub-Kategori')

@section('content')
<div class="max-w-xl">
    <a href="{{ route('sysadmin.manage-sub-categories.index', $subCategory->course_category_id) }}" class="text-sm text-gray-600 hover:underline mb-4 inline-block">< Kembali</a>
    <h2 class="text-2xl font-bold mb-4">Edit Sub-Kategori: {{ $subCategory->name }}</h2>
    <div class="bg-white p-6 rounded-lg border-2 border-gray-100">
        <form action="{{ route('sysadmin.manage-sub-categories.update', $subCategory) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block mb-1 font-medium text-gray-700">Nama Sub-Kategori</label>
                <input type="text" name="name" id="name" class="w-full border-2 border-gray-200 px-3 py-2 rounded-md focus:outline-none focus:border-gray-500 @error('name') border-gray-500 @enderror" value="{{ old('name', $subCategory->name ?? '') }}" required>
                @error('name') <p class="text-gray-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center space-x-2">
                <button type="submit" class="bg-gray-800 hover:bg-gray-900 text-white font-bold py-2 px-4 rounded-md transition">Simpan Perubahan</button>
                <a href="{{ route('sysadmin.manage-sub-categories.index', $subCategory->course_category_id) }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-md transition">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection