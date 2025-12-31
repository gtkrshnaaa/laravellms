@extends('layouts.sysadmin')
@section('title', 'Kelola Sub-Kategori')

@section('content')
<div class="mb-6">
    <a href="{{ route('sysadmin.manage-categories.index') }}" class="inline-flex items-center text-sm text-secondary hover:text-primary transition-colors mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Kembali ke Daftar Kategori
    </a>
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-primary">Kelola Sub-Kategori</h2>
            <p class="text-secondary text-sm">Kategori Induk: <span class="font-mono text-primary font-bold">{{ $category->name }}</span></p>
        </div>
    </div>
</div>

{{-- Form Tambah Cepat --}}
<div class="bg-surface border border-border rounded-xl shadow-sm p-6 mb-8">
    <h3 class="text-lg font-bold text-primary mb-4 flex items-center gap-2">
        <span class="w-1.5 h-6 bg-blue-500 rounded-full"></span>
        Tambah Sub-Kategori Baru
    </h3>
    <form action="{{ route('sysadmin.manage-sub-categories.store', $category) }}" method="POST">
        @csrf
        <div class="flex flex-col md:flex-row items-start md:items-center gap-4">
            <div class="flex-1 w-full">
                <input type="text" name="name" 
                    placeholder="Masukkan nama sub-kategori (contoh: Backend, Frontend)" 
                    class="w-full bg-background border border-border rounded-lg px-4 py-2.5 text-primary placeholder-secondary/50 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors duration-200" 
                    required>
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <button type="submit" class="w-full md:w-auto px-6 py-2.5 bg-primary text-background font-medium rounded-lg hover:bg-primary/90 transition-colors focus:ring-2 focus:ring-primary focus:ring-offset-2 whitespace-nowrap">
                + Tambah
            </button>
        </div>
    </form>
</div>

@if (session('success'))
    <div class="bg-green-500/10 border border-green-500/50 text-green-700 dark:text-green-400 p-4 rounded-lg mb-6" role="alert">
        {{ session('success') }}
    </div>
@endif

{{-- Daftar Sub-Kategori --}}
<div class="bg-surface border border-border rounded-xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead class="bg-secondary/5 border-b border-border">
                <tr>
                    <th class="px-6 py-4 font-semibold text-secondary uppercase tracking-wider text-xs">Nama Sub-Kategori</th>
                    <th class="px-6 py-4 font-semibold text-secondary uppercase tracking-wider text-xs">Slug</th>
                    <th class="px-6 py-4 font-semibold text-secondary uppercase tracking-wider text-xs text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border">
                @forelse ($subCategories as $subCategory)
                    <tr class="hover:bg-primary/5 transition-colors">
                        <td class="px-6 py-4 text-primary font-medium">{{ $subCategory->name }}</td>
                        <td class="px-6 py-4 text-secondary font-mono text-xs">{{ $subCategory->slug }}</td>
                        <td class="px-6 py-4 space-x-2 text-right">
                            <a href="{{ route('sysadmin.manage-sub-categories.edit', $subCategory) }}" class="text-blue-500 hover:text-blue-600 transition-colors font-medium text-xs">Edit</a>
                            <form action="{{ route('sysadmin.manage-sub-categories.destroy', $subCategory) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus sub-kategori ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-600 transition-colors font-medium ml-2 text-xs">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-8 text-center text-secondary">
                            <div class="flex flex-col items-center justify-center">
                                <span class="block mb-2 text-2xl text-secondary/30">☹</span>
                                Belum ada sub-kategori.
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">
    {{ $subCategories->links() }}
</div>
@endsection