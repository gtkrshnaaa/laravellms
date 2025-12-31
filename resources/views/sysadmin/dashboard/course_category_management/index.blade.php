@extends('layouts.sysadmin')
@section('title', 'Manajemen Kategori Kursus')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-2xl font-bold text-primary">Manajemen Kategori Kursus</h2>
        <p class="text-secondary text-sm">Kelola kategori utama untuk pengelompokan kursus.</p>
    </div>
    <a href="{{ route('sysadmin.manage-categories.create') }}" class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-lg font-semibold text-xs text-background uppercase tracking-widest hover:bg-primary/90 active:bg-primary focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 transition ease-in-out duration-150">
        + Tambah Kategori
    </a>
</div>

@if (session('success'))
    <div class="bg-green-500/10 border border-green-500/50 text-green-700 dark:text-green-400 p-4 rounded-lg mb-6" role="alert">
        {{ session('success') }}
    </div>
@endif

<div class="bg-surface border border-border rounded-xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead class="bg-secondary/5 border-b border-border">
                <tr>
                    <th class="px-6 py-4 font-semibold text-secondary uppercase tracking-wider text-xs">Nama Kategori</th>
                    <th class="px-6 py-4 font-semibold text-secondary uppercase tracking-wider text-xs">Slug</th>
                    <th class="px-6 py-4 font-semibold text-secondary uppercase tracking-wider text-xs text-center">Sub-Kategori</th>
                    <th class="px-6 py-4 font-semibold text-secondary uppercase tracking-wider text-xs text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border">
                @forelse ($categories as $category)
                    <tr class="hover:bg-primary/5 transition-colors">
                        <td class="px-6 py-4 text-primary font-medium">{{ $category->name }}</td>
                        <td class="px-6 py-4 text-secondary font-mono text-xs">{{ $category->slug }}</td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-500/10 text-blue-700 dark:text-blue-400 border border-blue-500/20">
                                {{ $category->sub_categories_count }}
                            </span>
                        </td>
                        <td class="px-6 py-4 space-x-2 text-right whitespace-nowrap">
                            <a href="{{ route('sysadmin.manage-sub-categories.index', $category) }}" class="inline-flex items-center px-3 py-1 bg-surface border border-border rounded-md text-xs font-medium text-secondary hover:text-primary hover:border-primary transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                                Manage Sub
                            </a>
                            <a href="{{ route('sysadmin.manage-categories.edit', $category) }}" class="text-blue-500 hover:text-blue-600 transition-colors font-medium text-xs">Edit</a>
                            <form action="{{ route('sysadmin.manage-categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus? Menghapus kategori akan menghapus semua sub-kategorinya.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-600 transition-colors font-medium ml-1 text-xs">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-secondary">
                            <div class="flex flex-col items-center justify-center">
                                <span class="block mb-2 text-2xl text-secondary/30">☹</span>
                                Belum ada kategori yang dibuat.
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">
    {{ $categories->links() }}
</div>
@endsection