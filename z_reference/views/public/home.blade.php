@extends('layouts.public')

@section('content')
    <!-- Hero Section -->
    <!-- Top Banner Carousel -->
    <section class="relative pt-24 pb-0 md:pt-32 md:pb-0 overflow-hidden mb-0" x-data="homeCarousel">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-zinc-800/20 via-background to-background opacity-40"></div>
        
        <div class="container mx-auto px-4 relative z-10 text-center min-h-[300px] flex flex-col justify-center items-center">
            
            <!-- Grid Container for Stacking Slides -->
            <div class="grid grid-cols-1 relative w-full max-w-7xl mx-auto">
                <template x-for="(slide, index) in slides" :key="index">
                    <div class="col-start-1 row-start-1 flex flex-col justify-center items-center transition-all ease-in-out"
                         x-show="activeSlide === index"
                         x-transition:enter="duration-500 delay-300 opacity-0 translate-y-8"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="duration-300 opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 -translate-y-8" 
                    >
                        <h1 class="text-4xl md:text-8xl lg:text-9xl font-bold tracking-tighter text-primary mb-8 leading-tight pb-2" x-html="slide.title"></h1>
                        <p class="text-lg md:text-2xl text-secondary max-w-4xl mx-auto" x-html="slide.subtitle"></p>
                    </div>
                </template>
                
                <!-- Hidden spacer to force minimum height preventing layout shift -->
                <div class="col-start-1 row-start-1 flex flex-col justify-center items-center invisible pointer-events-none" aria-hidden="true">
                     <h1 class="text-4xl md:text-8xl lg:text-9xl font-bold tracking-tighter mb-8 leading-tight pb-2">
                        Produk Digital <br> + Jasa Web Dev
                     </h1>
                     <p class="text-lg md:text-2xl max-w-4xl mx-auto">
                        Solusi lengkap untuk kebutuhan digital mahasiswa & UMKM
                     </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Validation & Scarcity Board -->
    <section class="py-6 bg-background">
        <div class="container mx-auto px-4">
            <div class="bg-surface border border-border rounded-xl p-6 md:p-8 flex flex-col md:flex-row items-start md:items-center justify-between gap-6 relative overflow-hidden">
                <!-- Glowing background effect -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-green-500/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>

                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <span class="relative flex h-3 w-3">
                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                          <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                        </span>
                        <h3 class="text-sm font-bold text-green-500 tracking-wider uppercase">Status: Team is Coding</h3>
                    </div>
                    <h2 class="text-2xl font-bold text-primary mb-1">Kuota Minggu Ini</h2>
                    <p class="text-secondary text-sm">Amankan kuota kamu sebelum penuh, kita gak mau ghosting kamu.</p>
                </div>

                <div class="w-full md:w-1/2 lg:w-1/3">
                    <div class="flex items-end justify-between mb-2">
                        <span class="text-xs font-mono text-primary font-bold">{{ $usedSlots }}/{{ $weeklyLimit }} PROJECT DIAMBIL</span>
                        <span class="text-xs font-mono {{ $slotsRemaining > 0 ? 'text-green-500' : 'text-red-500' }}">
                            {{ $slotsRemaining > 0 ? $slotsRemaining . ' KUOTA SISA' : 'FULL BOOKED' }}
                        </span>
                    </div>
                    <div class="w-full bg-background border border-border rounded-full h-4 overflow-hidden relative">
                         <!-- Progress Bar -->
                         <div class="absolute top-0 left-0 h-full bg-gradient-to-r from-green-400 to-emerald-600 transition-all duration-1000 ease-out" style="width: {{ ($usedSlots / $weeklyLimit) * 100 }}%"></div>
                         <!-- Striped pattern overlay -->
                         <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGRlZnM+PHBhdHRlcm4gaWQ9InAiIHdpZHRoPSI4IiBoZWlnaHQ9IjgiIHBhdHRlcm5Vbml0cz0idXNlclNwYWNlT25Vc2UiPjxwYXRoIGQ9Ik0wIDhMOCAwTTAgMEw4IDgiIHN0cm9rZT0icmdiYSgyNTUsMjU1LDI1NSwwLjEpIiBzdHJva2Utd2lkdGg9IjEiLz48L2Rlc2ZzPjxyZWN0IHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9InVybCgjcCkiLz48L3N2Zz4=')] opacity-30"></div>
                    </div>
                    <p class="text-[10px] text-secondary mt-2 text-right italic">Reset setiap Senin. Siapa cepat dia dapat!</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Service CTA Sections -->
    @foreach($serviceTypes as $serviceType)
    <section class="py-12 bg-background">
        <div class="container mx-auto px-4">
            <div class="relative overflow-hidden bg-gradient-to-br from-surface via-surface to-surface border border-border rounded-2xl p-8 md:p-12 group hover:border-primary/30 transition-all duration-500">
                <!-- Gradient Accent -->
                <div class="absolute -top-24 -right-24 w-64 h-64 bg-gradient-to-br {{ $loop->first ? 'from-blue-500/20 via-purple-500/20 to-pink-500/20' : 'from-green-400/20 via-cyan-500/20 to-blue-500/20' }} rounded-full blur-3xl group-hover:scale-150 transition-transform duration-700"></div>
                <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-gradient-to-tr {{ $loop->first ? 'from-purple-500/10 to-transparent' : 'from-teal-500/10 to-transparent' }} rounded-full blur-3xl"></div>
                
                <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <!-- Content Left -->
                    <div class="lg:col-span-8">
                        <!-- Status Badge -->
                        @if($serviceType->is_open)
                        <div class="inline-flex items-center gap-2 bg-green-500/10 border border-green-500/30 text-green-400 text-xs font-bold px-3 py-1.5 rounded-full mb-4">
                            <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                            AVAILABLE NOW
                        </div>
                        @endif

                        <!-- Icon -->
                        @if($serviceType->icon_class)
                        <div class="mb-4">
                            <i class="{{ $serviceType->icon_class }} text-5xl text-primary/80"></i>
                        </div>
                        @endif

                        <!-- Title & Description -->
                        <h2 class="text-3xl md:text-4xl font-bold text-primary mb-3 group-hover:text-primary/90 transition-colors">
                            {{ $serviceType->card_title }}
                        </h2>
                        <p class="text-secondary text-lg leading-relaxed max-w-2xl">
                            {{ $serviceType->card_description }}
                        </p>
                    </div>

                    <!-- CTA Right -->
                    <div class="lg:col-span-4 flex justify-start lg:justify-end">
                        <a href="{{ route('services.show', $serviceType->slug) }}" 
                           class="inline-flex items-center gap-3 bg-primary text-background font-bold px-8 py-4 rounded-xl hover:opacity-90 transition-all hover:gap-4 shadow-lg shadow-primary/20">
                            <span>Lihat Paket</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endforeach


    <!-- Portfolio Showcase Section -->
    @if($portfolios->count() > 0)
    <section class="py-20 bg-background">
        <div class="container mx-auto px-4">
            <!-- Header Banner -->
            <div class="relative overflow-hidden rounded-3xl bg-surface border border-border px-8 py-12 mb-12">
                <!-- Background Effects -->
                <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/2 w-96 h-96 bg-primary/5 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 translate-y-1/2 -translate-x-1/2 w-64 h-64 bg-purple-500/10 rounded-full blur-3xl"></div>

                <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
                    <div class="text-center md:text-left">
                         <h2 class="text-3xl md:text-5xl font-bold text-primary mb-4 tracking-tight">
                            Our <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-500">Masterpieces</span>
                        </h2>
                        <p class="text-secondary text-lg max-w-xl">
                            Lihat gimana kita ngebantu bisnis dan mahasiswa step up game mereka. Real results, no cap.
                        </p>
                    </div>
                    
                    <a href="{{ route('portfolio.index') }}" class="group relative inline-flex items-center gap-3 bg-primary text-background font-bold px-8 py-4 rounded-full overflow-hidden transition-transform hover:scale-105">
                        <span class="relative z-10">Lihat Semua Karya</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 relative z-10 group-hover:translate-x-1 transition-transform">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($portfolios as $portfolio)
                <div class="group bg-surface border border-border rounded-2xl overflow-hidden hover:shadow-xl hover:shadow-primary/5 hover:border-primary/30 transition-all duration-300">
                    <!-- Image -->
                    <div class="relative aspect-[16/10] overflow-hidden">
                        @if($portfolio->image_path)
                            <img src="{{ Storage::url($portfolio->image_path) }}" alt="{{ $portfolio->title }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700">
                        @else
                            <div class="w-full h-full bg-background/50 flex items-center justify-center text-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 opacity-30">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>
                            </div>
                        @endif
                        
                        <!-- Overlay Tech Stack -->
                        <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/90 to-transparent pt-12 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="flex flex-wrap gap-1.5">
                                @foreach($portfolio->tech_stack ?? [] as $tech)
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-white/10 text-white border border-white/20 backdrop-blur-sm">
                                        {{ $tech }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        <h3 class="text-xl font-bold text-primary mb-2 line-clamp-1 group-hover:text-blue-500 transition-colors">
                            {{ $portfolio->title }}
                        </h3>
                        <p class="text-secondary text-sm line-clamp-2 mb-4">
                            {{ $portfolio->description }}
                        </p>
                        @if($portfolio->demo_url)
                            <a href="{{ $portfolio->demo_url }}" target="_blank" class="text-xs font-bold text-primary hover:underline flex items-center gap-1">
                                View Demo 
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3 h-3">
                                    <path fill-rule="evenodd" d="M4.25 5.5a.75.75 0 00-.75.75v8.5c0 .414.336.75.75.75h8.5a.75.75 0 00.75-.75v-4a.75.75 0 011.5 0v4A2.25 2.25 0 0112.75 17h-8.5A2.25 2.25 0 012 14.75v-8.5A2.25 2.25 0 014.25 4h5a.75.75 0 010 1.5h-5z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Mobile Link Removed (Moved to Banner) -->
        </div>
    </section>
    @endif

    <!-- Featured Section -->
    <section class="py-20 bg-background" x-data="featured">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between mb-12">
                <div>
                    <h2 class="text-3xl font-bold text-primary mb-2">Yang Baru Nih</h2>
                    <p class="text-secondary">Koleksi paling fresh di library.</p>
                </div>
                <a href="{{ route('catalog.index') }}" class="hidden md:inline-flex bg-primary text-background font-bold py-2.5 px-6 rounded-full hover:opacity-90 transition-transform hover:scale-105 shadow-md shadow-primary/10 text-sm">
                    Jelajah Katalog
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($featuredProducts as $product)
                <a href="{{ route('product.show', $product->slug) }}" class="group block">
                    <div class="bg-surface border border-border rounded-xl overflow-hidden mb-4 transition-all duration-300 group-hover:border-primary/20 group-hover:shadow-2xl group-hover:shadow-primary/5">
                        <div class="aspect-[3/2] bg-current/5 relative">
                            @if($product->thumbnail)
                                <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->title }}" class="absolute inset-0 w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity">
                            @else
                                <div class="absolute inset-0 flex items-center justify-center text-secondary">Gak ada gambar</div>
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
                @endforeach
            </div>

            <div class="mt-12 text-center md:hidden">
                <a href="{{ route('catalog.index') }}" class="text-sm font-medium text-secondary hover:text-primary hover:underline decoration-primary/30">
                    Lihat Semua &rarr;
                </a>
            </div>
        </div>
        </div>
    </section>

    <!-- Bottom CTA Banner -->
    <section class="py-12 md:py-20 mb-12">
        <div class="container mx-auto px-4">
            <div class="relative overflow-hidden rounded-3xl bg-primary px-8 py-12 md:px-12 md:py-16 lg:flex lg:items-center lg:justify-between shadow-2xl shadow-primary/20">
                 <!-- Background Gradients -->
                 <div class="absolute top-0 left-0 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-gradient-to-br from-blue-500/30 to-purple-500/30 blur-3xl rounded-full pointer-events-none"></div>
                 <div class="absolute bottom-0 right-0 translate-x-1/2 translate-y-1/2 w-[500px] h-[500px] bg-gradient-to-tl from-red-500/30 to-yellow-500/30 blur-3xl rounded-full pointer-events-none"></div>

                <div class="relative z-10 text-center lg:text-left mb-8 lg:mb-0">
                    <h2 class="text-3xl font-bold tracking-tight text-background sm:text-4xl leading-tight">
                        Udah siap jadi <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 to-orange-400">Mahasiswa Ambis?</span>
                    </h2>
                    <p class="mt-4 max-w-xl text-lg text-background lg:mx-0">
                        Join 9/10 mahasiswa yang udah ngerasain impact-nya. Gak usah ragu, gaspol sekarang juga.
                    </p>
                </div>
                <div class="relative z-10 flex justify-center lg:justify-end">
                    <a href="{{ route('register') }}" class="rounded-full bg-background px-8 py-3.5 text-sm font-bold text-primary shadow-sm hover:bg-surface focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white transition-all transform hover:scale-105">
                        Gabung Sekarang
                    </a>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('featured', () => ({
                wishlisted: @json($featuredProducts->filter(fn($p) => $p->wishlists_exists)->pluck('id')),
                
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

            Alpine.data('homeCarousel', () => ({
                activeSlide: 0,
                slides: [
                    {
                        title: 'Produk Digital <br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500">+ Jasa Web Dev</span>',
                        subtitle: 'Solusi lengkap untuk kebutuhan digital mahasiswa & UMKM'
                    },
                    {
                        title: 'Build Your Website, <br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 via-blue-500 to-purple-600">Professional & Fast</span>',
                        subtitle: 'Static, PHP Native, Laravel. Semua Ada. Hosting 1 Bulan Included!'
                    },
                    {
                        title: 'Academic Products <br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-pink-500 via-orange-400 to-yellow-400">Ready to Download</span>',
                        subtitle: 'Template, Source Code, Assets. Everything You Need in One Place'
                    }
                ],
                init() {
                    setInterval(() => {
                        this.activeSlide = (this.activeSlide + 1) % this.slides.length;
                    }, 5000);
                }
            }))
        })
    </script>
@endsection
