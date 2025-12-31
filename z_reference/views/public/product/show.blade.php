@extends('layouts.public')

@section('title', $product->title)

@section('content')
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-24">
            
            <!-- Image Column -->
            <!-- Image Gallery Column -->
            <div x-data="{ 
                images: [
                    @if($product->thumbnail) '{{ asset('storage/' . $product->thumbnail) }}', @endif
                    @foreach($product->images as $img) '{{ asset('storage/' . $img->image_path) }}', @endforeach
                ],
                activeImage: null,
                activeIndex: 0,
                lightboxOpen: false,
                
                init() {
                    if (this.images.length > 0) {
                        this.activeImage = this.images[0];
                    }
                },
                
                setActive(idx) {
                    this.activeIndex = idx;
                    this.activeImage = this.images[idx];
                },
                next() {
                    this.activeIndex = (this.activeIndex + 1) % this.images.length;
                    this.activeImage = this.images[this.activeIndex];
                },
                prev() {
                    this.activeIndex = (this.activeIndex - 1 + this.images.length) % this.images.length;
                    this.activeImage = this.images[this.activeIndex];
                }
            }">
                 <!-- Main Image -->
                 <div class="bg-surface border border-border rounded-2xl overflow-hidden shadow-2xl shadow-blue-900/5 mb-4 group relative">
                    <div class="aspect-[4/3] bg-current/5 relative cursor-pointer" @click="lightboxOpen = true">
                         <template x-if="activeImage">
                            <img :src="activeImage" alt="{{ $product->title }}" class="absolute inset-0 w-full h-full object-contain transition-transform duration-500 group-hover:scale-105">
                         </template>
                         <template x-if="!activeImage">
                            <div class="absolute inset-0 flex items-center justify-center text-secondary">Gak ada gambar</div>
                         </template>
                         
                         <!-- Zoom Hint -->
                         <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center pointer-events-none">
                             <span class="text-white font-medium flex items-center gap-2">
                                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                     <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607zM10.5 7.5v6m3-3h-6" />
                                 </svg>
                                 Zoom
                             </span>
                         </div>
                    </div>
                 </div>

                 <!-- Thumbnails -->
                 <div class="grid grid-cols-5 gap-2" x-show="images.length > 1">
                    <template x-for="(img, index) in images" :key="index">
                        <button 
                            @click="setActive(index)"
                            class="aspect-square rounded-lg overflow-hidden border-2 transition-all relative bg-surface"
                            :class="activeIndex === index ? 'border-primary ring-2 ring-primary/20' : 'border-transparent opacity-60 hover:opacity-100'"
                        >
                            <img :src="img" class="w-full h-full object-cover">
                        </button>
                    </template>
                 </div>

                 <!-- Lightbox Modal -->
                 <div 
                    x-show="lightboxOpen" 
                    style="display: none;"
                    class="fixed inset-0 z-50 flex items-center justify-center bg-black/95 backdrop-blur-sm p-4"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    @keydown.escape.window="lightboxOpen = false"
                 >
                    <!-- Close Button -->
                    <button @click="lightboxOpen = false" class="absolute top-4 right-4 text-white/50 hover:text-white p-2 z-50">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <!-- Navigation -->
                    <button @click.stop="prev()" class="absolute left-4 text-white/50 hover:text-white p-2 z-50" x-show="images.length > 1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                        </svg>
                    </button>
                    <button @click.stop="next()" class="absolute right-4 text-white/50 hover:text-white p-2 z-50" x-show="images.length > 1">
                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </button>

                    <!-- Main Lightbox Image -->
                    <div class="max-w-7xl max-h-screen w-full relative flex items-center justify-center" @click.outside="lightboxOpen = false">
                        <img :src="activeImage" class="max-w-full max-h-[90vh] object-contain rounded-lg shadow-2xl">
                    </div>
                    
                    <!-- Counter -->
                    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 text-white/70 font-mono text-sm bg-white/10 px-4 py-1 rounded-full border border-white/10" x-show="images.length > 1">
                        <span x-text="activeIndex + 1"></span> / <span x-text="images.length"></span>
                    </div>
                 </div>
            </div>

            <!-- Details Column -->
            <div class="flex flex-col justify-center">
                <div class="mb-6">
                    <a href="{{ route('catalog.index', ['category' => $product->category->slug]) }}" class="text-sm text-secondary hover:text-primary bg-surface px-3 py-1 rounded-full inline-block mb-4 transition-colors">
                        {{ $product->category->name }}
                    </a>
                    <h1 class="text-4xl md:text-5xl font-bold tracking-tighter text-primary mb-4">{{ $product->title }}</h1>
                    <div class="flex items-center gap-4">
                         <span class="text-2xl font-mono text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                    </div>

                    <!-- Social Proof / Stats -->
                    <div class="flex flex-wrap items-center gap-x-6 gap-y-2 mt-6 mb-8 text-sm font-mono text-secondary border-y border-border py-4">
                        <!-- Views -->
                        <div class="flex items-center gap-2" title="Dilihat {{ number_format($product->views) }} kali">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-blue-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>{{ number_format($product->views) }}</span>
                        </div>

                        <!-- Sales (Manual) -->
                        @if($product->sales_count > 0)
                        <div class="flex items-center gap-2" title="Sudah terjual {{ number_format($product->sales_count) }} kali">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-orange-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>
                            <span class="text-primary">{{ number_format($product->sales_count) }}</span>
                        </div>
                        @endif

                        <!-- Wishlists -->
                        <div class="flex items-center gap-2" title="Disimpan oleh {{ number_format($product->wishlists_count) }} orang">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-pink-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                            </svg>
                            <span>{{ number_format($product->wishlists_count) }}</span>
                        </div>
                    </div>
                </div>

                <div class="prose dark:prose-invert prose-zinc max-w-none mb-8">
                    {!! nl2br(e($product->description)) !!}
                </div>

                <div class="flex flex-col sm:flex-row gap-4 border-t border-border pt-8">
                    @if($product->external_link)
                    <a href="{{ $product->external_link }}" target="_blank" rel="noopener noreferrer" class="flex-1 bg-primary text-background font-bold py-4 px-8 rounded-xl text-center hover:opacity-90 transition-transform hover:scale-[1.02] flex items-center justify-center gap-2">
                        Amankan Sekarang
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                        </svg>
                    </a>
                    @else
                    <button disabled class="flex-1 bg-surface text-secondary font-bold py-4 px-8 rounded-xl cursor-not-allowed">
                        Yah, Kosong
                    </button>
                    @endif
                    
                    {{-- Wishlist Toggle --}}
                    @auth('buyer')
                    <div x-data="{ 
                        wishlisted: {{ Auth::guard('buyer')->user()->wishlists()->where('product_id', $product->id)->exists() ? 'true' : 'false' }},
                        loading: false,
                        toggle() {
                            this.loading = true;
                            fetch('{{ route('buyer.wishlist.toggle') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                                },
                                body: JSON.stringify({ product_id: {{ $product->id }} })
                            })
                            .then(res => res.json())
                            .then(data => {
                                this.wishlisted = (data.status === 'added');
                                this.loading = false;
                            })
                            .catch(err => {
                                console.error(err);
                                this.loading = false;
                            });
                        }
                    }">
                        <button @click="toggle()" :disabled="loading" class="bg-surface text-primary p-4 rounded-xl hover:bg-surface/80 border border-border transition-colors group h-full flex items-center justify-center w-16">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" 
                                class="w-6 h-6 transition-colors"
                                :class="wishlisted ? 'fill-red-500 stroke-red-500' : 'group-hover:fill-red-500 group-hover:stroke-red-500'">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                            </svg>
                        </button>
                    </div>
                    @endauth
                </div>
                
                <p class="text-xs text-secondary mt-4 text-center sm:text-left">
                    Pembayaran aman via pihak ketiga (Mayar/Gumroad).
                </p>
            </div>

        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
        <div class="mt-24 border-t border-border pt-12" x-data="related">
            <h2 class="text-3xl font-bold text-primary mb-2">Mungkin Kamu Suka</h2>
            <p class="text-secondary mb-8">Cek juga barang simpenan lainnya.</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($relatedProducts as $related)
                <a href="{{ route('product.show', $related->slug) }}" class="group block">
                    <div class="bg-surface border border-border rounded-xl overflow-hidden mb-4 transition-all duration-300 group-hover:border-primary/20 group-hover:shadow-2xl group-hover:shadow-primary/5">
                        <div class="aspect-[3/2] bg-current/5 relative">
                            @if($related->thumbnail)
                                <img src="{{ asset('storage/' . $related->thumbnail) }}" alt="{{ $related->title }}" class="absolute inset-0 w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity">
                            @else
                                <div class="absolute inset-0 flex items-center justify-center text-secondary">No Image</div>
                            @endif
                            <div class="absolute top-3 right-3 bg-black/80 backdrop-blur text-white text-xs font-mono px-3 py-1 rounded-full border border-white/10">
                                Rp {{ number_format($related->price, 0, ',', '.') }}
                            </div>
                            <button 
                                @click.prevent="toggleWishlist({{ $related->id }})"
                                class="absolute bottom-3 right-3 bg-black/50 backdrop-blur p-2 rounded-full hover:bg-black/70 transition-colors group/btn z-10"
                                :class="{ 'text-red-500 bg-black/70': wishlisted.includes({{ $related->id }}) }"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" 
                                     :fill="wishlisted.includes({{ $related->id }}) ? 'currentColor' : 'none'" 
                                     viewBox="0 0 24 24" 
                                     stroke-width="1.5" 
                                     stroke="currentColor" 
                                     class="w-5 h-5 text-white group-hover/btn:scale-110 transition-transform"
                                     :class="{ 'text-red-500': wishlisted.includes({{ $related->id }}) }"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.008 11.525c.03.693-.069 1.341-.274 1.948-1.558 4.673-8.736 9.387-8.736 9.387S4.852 18.146 3.294 13.473c-.205-.607-.304-1.255-.274-1.948 0-2.834 2.128-5.132 4.965-5.32 2.373-.157 4.542 1.543 4.965 3.664.423-2.121 2.592-3.821 4.965-3.664 2.837.188 4.965 2.486 4.965 5.32z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-primary mb-1 group-hover:text-primary/70 transition-colors">{{ $related->title }}</h3>
                        <p class="text-sm text-secondary">{{ $related->category->name }}</p>
                    </div>
                </a>
                @endforeach
            </div>
            
            <script>
                document.addEventListener('alpine:init', () => {
                    Alpine.data('related', () => ({
                        wishlisted: @json($relatedProducts->filter(fn($p) => $p->wishlists_exists)->pluck('id')),
                        
                        async toggleWishlist(productId) {
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
        </div>
        @endif
    </div>
@endsection
