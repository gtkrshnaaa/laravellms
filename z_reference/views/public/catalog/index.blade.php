@extends('layouts.public')

@section('title', 'Katalog')

@section('content')
    <div class="container mx-auto px-4 py-12" x-data="catalog">
        <div class="flex flex-col md:flex-row gap-12">
            
            <!-- Sidebar -->
            <aside class="w-full md:w-64 flex-shrink-0">
                <div class="sticky top-24">
                    <h3 class="text-lg font-bold text-primary mb-6">Kategori</h3>
                    <div class="space-y-2">
                         <a href="{{ route('catalog.index') }}" class="block px-4 py-2 rounded-lg text-sm font-medium {{ is_null($currentCategory) ? 'bg-primary text-background' : 'text-secondary hover:text-primary hover:bg-surface' }} transition-colors">
                            Semua Resource
                        </a>
                        @foreach($categories as $category)
                            <a href="{{ route('catalog.index', ['category' => $category->slug]) }}" class="block px-4 py-2 rounded-lg text-sm font-medium {{ $currentCategory && $currentCategory->id === $category->id ? 'bg-primary text-background' : 'text-secondary hover:text-primary hover:bg-surface' }} transition-colors">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </aside>

            <!-- Product Grid -->
            <div class="flex-1">
                <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
                    <div>
                        <h1 class="text-3xl font-bold text-primary mb-2">{{ $currentCategory ? $currentCategory->name : 'Semua Resource' }}</h1>
                        <p class="text-secondary text-sm">Nampilin {{ $products->total() }} hasil</p>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4 w-full md:w-auto">
                        <!-- Search Form -->
                        <form action="{{ route('catalog.index') }}" method="GET" class="relative group w-full md:w-64">
                            @if(request('category'))
                                <input type="hidden" name="category" value="{{ request('category') }}">
                            @endif
                            @if(request('sort'))
                                <input type="hidden" name="sort" value="{{ request('sort') }}">
                            @endif
                            <input type="text" 
                                   name="search" 
                                   value="{{ request('search') }}" 
                                   placeholder="Cari cheat code..." 
                                   class="w-full bg-surface border border-border rounded-lg px-4 py-2 pl-10 text-sm focus:outline-none focus:border-primary transition-colors text-primary placeholder-zinc-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 absolute left-3 top-2.5 text-zinc-500 group-focus-within:text-primary transition-colors">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                            </svg>
                        </form>

                        <!-- Sort Dropdown -->
                        <div x-data="{ open: false }" class="relative w-full sm:w-48">
                            <button @click="open = !open" @click.away="open = false" class="w-full flex items-center justify-between bg-surface border border-border rounded-lg px-4 py-2 text-sm text-primary hover:border-primary transition-colors">
                                <span>
                                    @switch(request('sort'))
                                        @case('price_asc') Termurah @break
                                        @case('price_desc') Termahal @break
                                        @default Terbaru
                                    @endswitch
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>
                            <div x-show="open" 
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="absolute right-0 mt-2 w-full bg-surface border border-border rounded-lg shadow-xl z-10 py-1">
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'latest']) }}" class="block px-4 py-2 text-sm text-secondary hover:text-primary hover:bg-black/5 dark:hover:bg-white/5">Terbaru</a>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'price_asc']) }}" class="block px-4 py-2 text-sm text-secondary hover:text-primary hover:bg-black/5 dark:hover:bg-white/5">Termurah</a>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'price_desc']) }}" class="block px-4 py-2 text-sm text-secondary hover:text-primary hover:bg-black/5 dark:hover:bg-white/5">Termahal</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($products as $product)
                    <a href="{{ route('product.show', $product->slug) }}" class="group block">
                        <div class="bg-surface border border-border rounded-xl overflow-hidden mb-4 transition-all duration-300 group-hover:border-primary/20 group-hover:shadow-2xl group-hover:shadow-primary/5">
                            <div class="aspect-[3/2] bg-current/5 relative">
                                @if($product->thumbnail)
                                    <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->title }}" class="absolute inset-0 w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity">
                                @else
                                    <div class="absolute inset-0 flex items-center justify-center text-secondary">No Image</div>
                                @endif
                                <div class="absolute top-3 right-3 bg-black/80 backdrop-blur text-white text-xs font-mono px-3 py-1 rounded-full border border-white/10">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </div>
                                    <button 
                                    @click.prevent="toggleWishlist({{ $product->id }})"
                                    class="absolute bottom-3 right-3 bg-black/50 backdrop-blur p-2 rounded-full hover:bg-black/70 transition-colors group/btn z-10"
                                    :class="{ 'text-red-500 bg-black/70': wishlisted.includes({{ $product->id }}) }"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" 
                                         :fill="wishlisted.includes({{ $product->id }}) ? 'currentColor' : 'none'" 
                                         viewBox="0 0 24 24" 
                                         stroke-width="1.5" 
                                         stroke="currentColor" 
                                         class="w-5 h-5 text-white group-hover/btn:scale-110 transition-transform"
                                         :class="{ 'text-red-500': wishlisted.includes({{ $product->id }}) }"
                                    >
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.008 11.525c.03.693-.069 1.341-.274 1.948-1.558 4.673-8.736 9.387-8.736 9.387S4.852 18.146 3.294 13.473c-.205-.607-.304-1.255-.274-1.948 0-2.834 2.128-5.132 4.965-5.32 2.373-.157 4.542 1.543 4.965 3.664.423-2.121 2.592-3.821 4.965-3.664 2.837.188 4.965 2.486 4.965 5.32z" />
                                    </svg>
                                </button>
                                
                                <div class="absolute bottom-3 left-3 flex items-center gap-2">
                                    <div class="bg-black/80 backdrop-blur text-white/90 text-[10px] font-mono px-2 py-1 rounded-md border border-white/10 flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        {{ number_format($product->views) }}
                                    </div>
                                    @if($product->sales_count > 0)
                                    <div class="bg-orange-500/90 backdrop-blur text-white text-[10px] font-mono px-2 py-1 rounded-md border border-white/10 flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                        </svg>
                                        {{ number_format($product->sales_count) }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-primary mb-1 group-hover:text-primary/70 transition-colors">{{ $product->title }}</h3>
                            <p class="text-sm text-secondary">{{ $product->category->name }}</p>
                        </div>
                    </a>
                    @empty
                    <div class="col-span-full py-12 text-center border-2 border-dashed border-border rounded-xl">
                        <p class="text-secondary">Belum ada produk di kategori ini nich.</p>
                    </div>
                    @endforelse
                </div>

                <div class="mt-12">
                    {{ $products->withQueryString()->links() }}
                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('catalog', () => ({
                wishlisted: @json($products->filter(fn($p) => $p->wishlists_exists)->pluck('id')),
                
                async toggleWishlist(productId) {
                    // Check if user is logged in (you might want a better check)
                    @guest('buyer')
                        window.location.href = "{{ route('login') }}";
                        return;
                    @endguest

                    try {
                        const response = await fetch("{{ route('buyer.wishlist.toggle') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({ product_id: productId })
                        });

                        const data = await response.json();

                        if (data.status === 'added') {
                            this.wishlisted.push(productId);
                        } else {
                            this.wishlisted = this.wishlisted.filter(id => id !== productId);
                        }
                    } catch (error) {
                        console.error('Error toggling wishlist:', error);
                    }
                }
            }))
        })
    </script>
@endsection
