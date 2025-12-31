@extends('layouts.admin')

@section('title', 'Edit Category')

@section('content')
    <div class="max-w-2xl">
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-primary mb-2">Ubah Kategori</h2>
            <p class="text-secondary">Ubah detail kategori.</p>
        </div>

        <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-secondary mb-2">Nama Kategori</label>
                <input id="name" type="text" name="name" value="{{ old('name', $category->name) }}" required autofocus
                    class="w-full bg-background border border-border rounded-lg px-4 py-3 text-primary focus:ring-1 focus:ring-primary focus:border-primary transition-colors outline-none placeholder-secondary">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Icon Class -->
            <div>
                <label for="icon_class" class="block text-sm font-medium text-secondary mb-2">Kelas Ikon</label>
                <input id="icon_class" type="text" name="icon_class" value="{{ old('icon_class', $category->icon_class) }}" 
                    class="w-full bg-background border border-border rounded-lg px-4 py-3 text-primary focus:ring-1 focus:ring-primary focus:border-primary transition-colors outline-none placeholder-secondary font-mono">
                @error('icon_class')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Actions -->
            <div class="flex items-center gap-4 pt-4">
                <button type="submit" class="bg-primary text-background font-bold py-3 px-6 rounded-lg hover:opacity-90 transition-opacity">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.categories.index') }}" class="text-secondary hover:text-primary transition-colors">Gak Jadi</a>
            </div>
        </form>
    </div>
@endsection
