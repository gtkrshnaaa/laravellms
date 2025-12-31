@extends('layouts.admin')

@section('title', 'Categories')

@section('content')
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-bold text-primary mb-2">Kategori</h2>
            <p class="text-secondary">Atur kategori produkmu.</p>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="bg-primary text-background font-bold py-2 px-4 rounded-lg hover:opacity-90 transition-opacity text-sm">
            + Tambah Kategori
        </a>
    </div>

    <!-- Search -->
    <div class="mb-6 bg-surface border border-border rounded-xl p-4 shadow-sm hover:shadow-md transition-all duration-300">
        <form action="{{ route('admin.categories.index') }}" method="GET" class="flex gap-4">
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama kategori..." class="w-full bg-background border border-border rounded-lg px-4 py-2 text-primary focus:outline-none focus:border-primary transition-colors">
            </div>
            <button type="submit" class="bg-primary/10 text-primary px-6 py-2 rounded-lg hover:bg-primary/20 transition-colors font-medium">
                Cari
            </button>
        </form>
    </div>

    <div class="bg-surface border border-border rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300">
        <table class="w-full text-left">
            <thead>
                <tr class="border-b border-border bg-secondary/5">
                    <th class="px-6 py-4 text-xs font-medium text-secondary uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-4 text-xs font-medium text-secondary uppercase tracking-wider">Slug</th>
                    <th class="px-6 py-4 text-xs font-medium text-secondary uppercase tracking-wider">Ikon</th>
                    <th class="px-6 py-4 text-xs font-medium text-secondary uppercase tracking-wider text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border">
                @forelse($categories as $category)
                <tr class="hover:bg-primary/5 transition-colors">
                    <td class="px-6 py-4 text-primary font-medium">{{ $category->name }}</td>
                    <td class="px-6 py-4 text-secondary text-sm">{{ $category->slug }}</td>
                    <td class="px-6 py-4 text-secondary text-sm font-mono">{{ $category->icon_class ?? '-' }}</td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <a href="{{ route('admin.categories.edit', $category) }}" class="text-primary hover:underline text-sm">Edit</a>
                        
                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin mau dihapus?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-400 text-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-secondary">
                        Belum ada kategori. Tambah dulu gih.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $categories->links() }}
    </div>
@endsection
