@extends('layouts.admin')

@section('title', 'Products')

@section('content')
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-bold text-primary mb-2">Koleksi Produk</h2>
            <p class="text-secondary">Atur katalog jualan kamu.</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="bg-primary text-background font-bold py-2 px-4 rounded-lg hover:opacity-90 transition-opacity text-sm">
            + Tambah Barang
        </a>
    </div>

    <!-- Search & Filters -->
    <div class="mb-6 bg-surface border border-border rounded-xl p-4 shadow-sm hover:shadow-md transition-all duration-300">
        <form action="{{ route('admin.products.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama produk..." class="w-full bg-background border border-border rounded-lg px-4 py-2 text-primary focus:outline-none focus:border-primary transition-colors">
            </div>
            <div class="w-full md:w-48">
                <select name="category_id" class="w-full bg-background border border-border rounded-lg px-4 py-2 text-primary focus:outline-none focus:border-primary transition-colors">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="w-full md:w-32">
                <select name="status" class="w-full bg-background border border-border rounded-lg px-4 py-2 text-primary focus:outline-none focus:border-primary transition-colors">
                    <option value="">Status</option>
                    <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Draft</option>
                </select>
            </div>
            <button type="submit" class="bg-primary/10 text-primary px-6 py-2 rounded-lg hover:bg-primary/20 transition-colors font-medium">
                Filter
            </button>
        </form>
    </div>

    <div class="bg-surface border border-border rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300">
        <table class="w-full text-left">
            <thead>
                <tr class="border-b border-border bg-secondary/5">
                    <th class="px-6 py-4 text-xs font-medium text-secondary uppercase tracking-wider">Produk</th>
                    <th class="px-6 py-4 text-xs font-medium text-secondary uppercase tracking-wider">Kategori</th>
                    <th class="px-6 py-4 text-xs font-medium text-secondary uppercase tracking-wider">Mahar</th>
                    <th class="px-6 py-4 text-xs font-medium text-secondary uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-xs font-medium text-secondary uppercase tracking-wider text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border">
                @forelse($products as $product)
                <tr class="hover:bg-primary/5 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            @if($product->thumbnail)
                                <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="" class="w-10 h-10 rounded bg-current/5 object-cover">
                            @else
                                <div class="w-10 h-10 rounded bg-current/5 border border-border flex items-center justify-center text-secondary text-xs">Kosong</div>
                            @endif
                            <div>
                                <p class="text-primary font-medium">{{ $product->title }}</p>
                                <p class="text-secondary text-xs break-all">{{ $product->slug }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-secondary text-sm">{{ $product->category->name }}</td>
                    <td class="px-6 py-4 text-secondary text-sm font-mono">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $product->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ $product->is_active ? 'Aktif' : 'Draft' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <a href="{{ route('admin.products.images.index', $product) }}" class="text-indigo-400 hover:text-indigo-300 hover:underline text-sm font-medium">Gallery</a>
                        <a href="{{ route('admin.products.edit', $product) }}" class="text-primary hover:underline text-sm">Edit</a>
                        
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin mau dihapus?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-400 text-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-secondary">
                        Belum ada produk. Tambah dulu gih.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $products->links() }}
    </div>
@endsection
