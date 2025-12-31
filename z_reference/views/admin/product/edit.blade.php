@extends('layouts.admin')

@section('title', 'Edit Product')

@section('content')
    <div class="max-w-4xl">
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-primary mb-2">Ubah Produk</h2>
            <p class="text-secondary">Update detail produk.</p>
        </div>

        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title -->
                <div class="md:col-span-2">
                    <label for="title" class="block text-sm font-medium text-secondary mb-2">Nama Produk</label>
                    <input id="title" type="text" name="title" value="{{ old('title', $product->title) }}" required autofocus
                        class="w-full bg-background border border-border rounded-lg px-4 py-3 text-primary focus:ring-1 focus:ring-primary focus:border-primary transition-colors outline-none placeholder-secondary">
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category -->
                <div>
                    <label for="category_id" class="block text-sm font-medium text-secondary mb-2">Kategori</label>
                    <select id="category_id" name="category_id" required
                        class="w-full bg-background border border-border rounded-lg px-4 py-3 text-primary focus:ring-1 focus:ring-primary focus:border-primary transition-colors outline-none cursor-pointer">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Price -->
                <div>
                    <label for="price" class="block text-sm font-medium text-secondary mb-2">Harga (Rupiah)</label>
                    <input id="price" type="number" name="price" value="{{ old('price', $product->price) }}" placeholder="50000"
                        class="w-full bg-background border border-border rounded-lg px-4 py-3 text-primary focus:ring-1 focus:ring-primary focus:border-primary transition-colors outline-none placeholder-secondary font-mono">
                    @error('price')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Sales Count -->
                <div>
                    <label for="sales_count" class="block text-sm font-medium text-secondary mb-2">Jumlah Terjual (Manual Input)</label>
                    <input id="sales_count" type="number" name="sales_count" value="{{ old('sales_count', $product->sales_count) }}" placeholder="0"
                        class="w-full bg-background border border-border rounded-lg px-4 py-3 text-primary focus:ring-1 focus:ring-primary focus:border-primary transition-colors outline-none placeholder-secondary font-mono">
                    <p class="text-xs text-secondary mt-1">Cth: Isi 100 agar terlihat sudah terjual 100 kali.</p>
                    @error('sales_count')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                 <!-- External Link -->
                 <div class="md:col-span-2">
                    <label for="external_link" class="block text-sm font-medium text-secondary mb-2">Link Eksternal (Mayar/Gumroad)</label>
                    <input id="external_link" type="url" name="external_link" value="{{ old('external_link', $product->external_link) }}" placeholder="https://..."
                        class="w-full bg-background border border-border rounded-lg px-4 py-3 text-primary focus:ring-1 focus:ring-primary focus:border-primary transition-colors outline-none placeholder-secondary font-mono">
                    @error('external_link')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Thumbnail -->
                <div class="md:col-span-2">
                    <label for="thumbnail" class="block text-sm font-medium text-secondary mb-2">Gambar Thumbnail</label>
                    
                    @if($product->thumbnail)
                        <div class="mb-4">
                            <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="Current Thumbnail" class="h-32 rounded bg-background object-cover border border-border">
                        </div>
                    @endif

                    <input id="thumbnail" type="file" name="thumbnail" accept="image/*"
                        class="w-full bg-background border border-border rounded-lg px-4 py-3 text-primary focus:ring-1 focus:ring-primary focus:border-primary transition-colors outline-none file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-surface file:text-primary hover:file:bg-surface/80">
                    <p class="text-xs text-secondary mt-1">Kosongin aja kalau gak mau ganti.</p>
                    @error('thumbnail')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-secondary mb-2">Deskripsi (Bisa HTML)</label>
                    <textarea id="description" name="description" rows="5"
                        class="w-full bg-background border border-border rounded-lg px-4 py-3 text-primary focus:ring-1 focus:ring-primary focus:border-primary transition-colors outline-none placeholder-secondary font-mono text-sm">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div class="md:col-span-2">
                    <div class="flex items-center gap-2">
                        <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }} class="w-4 h-4 rounded border-border bg-background text-primary focus:ring-0">
                        <label for="is_active" class="text-sm font-medium text-primary cursor-pointer">Diterbitkan</label>
                    </div>
                </div>

            </div>

            <!-- Actions -->
            <div class="flex items-center gap-4 pt-4">
                <button type="submit" class="bg-primary text-background font-bold py-3 px-6 rounded-lg hover:opacity-90 transition-opacity">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.products.index') }}" class="text-secondary hover:text-primary transition-colors">Gak Jadi</a>
            </div>
        </form>
    </div>
@endsection
