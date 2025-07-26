@extends('layouts.sysadmin')
@section('title', 'Manajemen Kategori Kursus')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h2 class="text-2xl font-bold">Manajemen Kategori Kursus</h2>
    <a href="{{ route('sysadmin.manage-categories.create') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md font-semibold transition">
        + Tambah Kategori
    </a>
</div>

@if (session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4 border border-green-200">{{ session('success') }}</div>
@endif

<div class="bg-white border-2 border-gray-100 rounded-lg overflow-x-auto">
    <table class="w-full text-left">
        <thead class="bg-gray-50">
            <tr>
                <th class="p-4 font-semibold">Nama Kategori</th>
                <th class="p-4 font-semibold">Slug</th>
                <th class="p-4 font-semibold">Jumlah Sub-Kategori</th>
                <th class="p-4 font-semibold">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse ($categories as $category)
                <tr>
                    <td class="p-4">{{ $category->name }}</td>
                    <td class="p-4 font-mono text-sm text-gray-500">{{ $category->slug }}</td>
                    <td class="p-4">{{ $category->sub_categories_count }}</td>
                    <td class="p-4 space-x-2 whitespace-nowrap">
                        <a href="{{ route('sysadmin.manage-sub-categories.index', $category) }}" class="bg-blue-100 text-blue-800 px-3 py-1 text-sm rounded-md font-bold hover:bg-blue-200 transition">
                            Manage
                        </a>
                        <a href="{{ route('sysadmin.manage-categories.edit', $category) }}" class="text-purple-600 hover:underline">Edit</a>
                        <form action="{{ route('sysadmin.manage-categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus? Menghapus kategori akan menghapus semua sub-kategorinya.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="p-4 text-center text-gray-500">Belum ada kategori.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">
    {{ $categories->links() }}
</div>
@endsection