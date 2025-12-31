@extends('layouts.admin')

@section('title', 'New Category')

@section('content')
    <div class="max-w-2xl">
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-primary mb-2">Tambah Kategori Baru</h2>
            <p class="text-secondary">Bikin kategori baru buat produkmu.</p>
        </div>

        <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-secondary mb-2">Nama Kategori</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                    class="w-full bg-background border border-border rounded-lg px-4 py-3 text-primary focus:ring-1 focus:ring-primary focus:border-primary transition-colors outline-none placeholder-secondary">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Icon Class -->
            <div>
                <label for="icon_class" class="block text-sm font-medium text-secondary mb-2">Kelas Ikon (FontAwesome/Heroicons)</label>
                <input id="icon_class" type="text" name="icon_class" value="{{ old('icon_class') }}" 
                    class="w-full bg-background border border-border rounded-lg px-4 py-3 text-primary focus:ring-1 focus:ring-primary focus:border-primary transition-colors outline-none placeholder-secondary font-mono">
                <p class="text-xs text-secondary mt-1">Example: <span class="font-mono text-gray-500">fa-solid fa-code</span></p>
                @error('icon_class')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Actions -->
            <div class="flex items-center gap-4 pt-4">
                <button type="submit" class="bg-primary text-background font-bold py-3 px-6 rounded-lg hover:opacity-90 transition-opacity">
                    Simpan Kategori
                </button>
                <a href="{{ route('admin.categories.index') }}" class="text-secondary hover:text-primary transition-colors">Gak Jadi</a>
            </div>
        </form>
    </div>
@endsection
