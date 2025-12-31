@extends('layouts.sysadmin')
@section('title', 'Edit Sub-Kategori')

@section('content')
<div class="max-w-2xl mx-auto">
    <a href="{{ route('sysadmin.manage-sub-categories.index', $subCategory->course_category_id) }}" class="inline-flex items-center text-sm text-secondary hover:text-primary transition-colors mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Kembali
    </a>

    <div class="mb-6">
        <h2 class="text-2xl font-bold text-primary">Edit Sub-Kategori</h2>
        <p class="text-secondary text-sm">Perbarui informasi sub-kategori: <span class="font-mono text-primary">{{ $subCategory->name }}</span></p>
    </div>

    <div class="p-6 bg-surface border border-border rounded-xl shadow-sm">
        <form action="{{ route('sysadmin.manage-sub-categories.update', $subCategory) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-secondary mb-2">Nama Sub-Kategori</label>
                <input type="text" name="name" id="name" 
                    class="w-full bg-background border border-border rounded-lg px-4 py-2.5 text-primary placeholder-secondary/50 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors duration-200" 
                    value="{{ old('name', $subCategory->name ?? '') }}" required>
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-border">
                <button type="submit" class="px-6 py-2.5 bg-primary text-background font-medium rounded-lg hover:bg-primary/90 transition-colors focus:ring-2 focus:ring-primary focus:ring-offset-2">
                    Simpan Perubahan
                </button>
                <a href="{{ route('sysadmin.manage-sub-categories.index', $subCategory->course_category_id) }}" class="px-6 py-2.5 bg-surface border border-border text-secondary font-medium rounded-lg hover:text-primary hover:border-primary transition-colors focus:ring-2 focus:ring-border">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection