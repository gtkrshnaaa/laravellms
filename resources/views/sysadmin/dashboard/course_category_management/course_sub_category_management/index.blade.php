@extends('layouts.sysadmin')
@section('title', 'Kelola Sub-Kategori')

@section('content')
<a href="{{ route('sysadmin.manage-categories.index') }}" class="text-sm text-gray-600 hover:underline mb-4 inline-block">< Kembali ke Daftar Kategori</a>
<h2 class="text-2xl font-bold mb-1">Kelola Sub-Kategori</h2>
<p class="text-gray-500 mb-6">Untuk Kategori: <span class="font-bold text-gray-700">{{ $category->name }}</span></p>

{{-- Form Tambah Cepat --}}
<div class="bg-white p-4 rounded-lg border-2 border-gray-100 mb-6">
    <h3 class="text-lg font-semibold mb-2">Tambah Sub-Kategori Baru</h3>
    <form action="{{ route('sysadmin.manage-sub-categories.store', $category) }}" method="POST">
        @csrf
        <div class="flex items-center space-x-2">
            <input type="text" name="name" placeholder="Nama Sub-Kategori (e.g. Pramugari)" class="w-full border-2 border-gray-200 px-3 py-2 rounded-md focus:outline-none focus:border-gray-500" required>
            <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md whitespace-nowrap font-semibold">Tambah</button>
        </div>
        @error('name') <p class="text-gray-500 text-sm mt-1">{{ $message }}</p> @enderror
    </form>
</div>

@if (session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4 border border-green-200">{{ session('success') }}</div>
@endif

{{-- Daftar Sub-Kategori --}}
<div class="bg-white border-2 border-gray-100 rounded-lg overflow-x-auto">
    <table class="w-full text-left">
        <thead class="bg-gray-50">
            <tr>
                <th class="p-4 font-semibold">Nama Sub-Kategori</th>
                <th class="p-4 font-semibold">Slug</th>
                <th class="p-4 font-semibold">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse ($subCategories as $subCategory)
                <tr>
                    <td class="p-4">{{ $subCategory->name }}</td>
                    <td class="p-4 font-mono text-sm text-gray-500">{{ $subCategory->slug }}</td>
                    <td class="p-4 space-x-2">
                        <a href="{{ route('sysadmin.manage-sub-categories.edit', $subCategory) }}" class="text-purple-600 hover:underline">Edit</a>
                        <form action="{{ route('sysadmin.manage-sub-categories.destroy', $subCategory) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus sub-kategori ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="p-4 text-center text-gray-500">Belum ada sub-kategori.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $subCategories->links() }}</div>
@endsection