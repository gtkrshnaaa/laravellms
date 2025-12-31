@extends('layouts.admin')

@section('title', 'Manage Gallery')

@section('content')
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-bold text-white mb-2">Gallery: {{ $product->title }}</h2>
            <p class="text-secondary">Upload foto tambahan, biar makin menggoda.</p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="text-secondary hover:text-white transition-colors">
            &larr; Balik ke List
        </a>
    </div>

    <!-- Upload Section -->
    <div class="mb-8 bg-surface border border-border rounded-xl p-6">
        <h3 class="text-xl font-bold text-white mb-4">Upload Foto Baru</h3>
        <form action="{{ route('admin.products.images.store', $product) }}" method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row gap-4">
            @csrf
            
            <div class="flex-1">
                <input type="file" name="images[]" multiple accept="image/*" class="block w-full text-sm text-secondary
                    file:mr-4 file:py-2.5 file:px-4
                    file:rounded-full file:border-0
                    file:text-sm file:font-semibold
                    file:bg-indigo-500 file:text-white
                    hover:file:bg-indigo-600
                    cursor-pointer bg-black rounded-lg border border-border focus:outline-none focus:border-indigo-500 transition-all
                ">
                <p class="mt-2 text-xs text-secondary">Bisa pilih banyak sekaligus. Max 2MB per foto.</p>
            </div>
            
            <button type="submit" class="bg-white text-black font-bold py-2.5 px-6 rounded-lg hover:bg-gray-200 transition-colors">
                Upload Gas!
            </button>
        </form>
        @if($errors->any())
            <div class="mt-4 p-4 bg-red-500/10 border border-red-500/20 rounded-lg">
                <ul class="list-disc list-inside text-red-500 text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <!-- Gallery Grid -->
    @if($product->images->isEmpty())
        <div class="text-center py-12 bg-surface border border-border rounded-xl border-dashed">
            <span class="text-4xl block mb-2">🤷‍♂️</span>
            <p class="text-secondary">Belum ada foto tambahan nih.</p>
        </div>
    @else
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
            @foreach($product->images as $image)
            <div class="group relative aspect-square bg-black rounded-xl overflow-hidden border border-border">
                <img src="{{ asset('storage/' . $image->image_path) }}" class="w-full h-full object-cover">
                
                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                    <form action="{{ route('admin.products.images.destroy', $image->id) }}" method="POST" onsubmit="return confirm('Hapus gambar ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 bg-red-500 text-white rounded-full hover:bg-red-600 transition-colors shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    @endif
@endsection
