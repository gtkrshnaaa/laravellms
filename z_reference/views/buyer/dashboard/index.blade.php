@extends('layouts.buyer')

@section('title', 'Koleksi')

@section('content')
    <!-- Welcome Banner Gen Z Style -->
    <!-- Welcome Banner Gen Z Style -->
    <div class="mb-12 relative overflow-hidden rounded-2xl bg-surface border border-border p-8 sm:p-12">
        <div class="absolute top-0 right-0 w-64 h-64 bg-primary/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
        <div class="relative z-10">
            <h1 class="text-4xl md:text-5xl font-black text-primary mb-4 tracking-tighter">
                Welcome back, <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-500 to-cyan-500">King! 👑</span>
            </h1>
            <p class="text-lg text-secondary max-w-2xl">
                Ruang penyimpanan harta karun digitalmu. Semua cheat code yang udah diamankan ada di sini.
            </p>
        </div>
    </div>

    <!-- Service Orders Section -->
    <div class="mb-12">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-primary mb-1">Orderan Jasa</h2>
                <p class="text-sm text-secondary">Progres project web & konsultasi kamu.</p>
            </div>
            @if($serviceOrders->count() > 0)
                <a href="{{ route('buyer.service.orders.index') }}" class="text-sm font-medium text-primary hover:underline flex items-center gap-1">
                    Lihat Semua
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            @endif
        </div>

        @if($serviceOrders->isEmpty())
             <div class="bg-surface border border-border rounded-xl p-8 text-center">
                <div class="w-12 h-12 bg-surface border border-border rounded-full flex items-center justify-center mx-auto mb-4 text-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-primary mb-1">Belum Ada Order</h3>
                <p class="text-sm text-secondary mb-4">Butuh website atau konsultasi? Gas order sekarang!</p>
                <a href="{{ route('services.index') }}" class="inline-flex items-center gap-2 bg-primary text-background px-4 py-2 rounded-lg text-sm font-medium hover:opacity-90 transition-opacity">
                    Cari Layanan
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($serviceOrders->take(3) as $order)
                <a href="{{ route('buyer.service.orders.show', $order->order_number) }}" class="group block bg-surface border border-border rounded-xl p-5 hover:border-primary/30 transition-all hover:shadow-lg hover:shadow-primary/5">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-10 h-10 rounded-lg bg-background border border-border flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-background transition-colors">
                            <i class="{{ $order->servicePackage->serviceType->icon_class ?? 'fas fa-box' }}"></i>
                        </div>
                        <span class="px-2.5 py-1 rounded-full text-xs font-bold 
                            @if($order->status == 'pending') bg-yellow-500/10 text-yellow-500
                            @elseif($order->status == 'active' || $order->status == 'in_progress') bg-blue-500/10 text-blue-500
                            @elseif($order->status == 'completed') bg-green-500/10 text-green-500
                            @elseif($order->status == 'cancelled') bg-red-500/10 text-red-500
                            @else bg-secondary/10 text-secondary @endif">
                            {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                        </span>
                    </div>
                    
                    <h3 class="font-bold text-primary mb-1 group-hover:text-primary/80 transition-colors">{{ $order->servicePackage->name }}</h3>
                    <p class="text-xs text-secondary mb-4">Order #{{ $order->order_number }}</p>
                    
                    <div class="flex items-center justify-between text-xs border-t border-border pt-3">
                        <span class="text-secondary">{{ $order->created_at->diffForHumans() }}</span>
                        <span class="font-mono font-medium text-primary">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>
                </a>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Collection Section -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-primary mb-2">Koleksi Produk</h1>
            <p class="text-secondary">Aset digital yang udah kamu simpan.</p>
        </div>
    </div>

    @if($wishlistedProducts->isEmpty())
        <div class="text-center py-24 bg-surface border border-border rounded-xl">
            <h3 class="text-xl font-bold text-primary mb-2">Koleksi masih sepi nih</h3>
            <p class="text-secondary mb-6">Kayaknya kamu belum nyimpen apa-apa deh.</p>
            <a href="{{ route('catalog.index') }}" class="bg-primary text-background font-bold py-3 px-8 rounded-full hover:opacity-90 transition-opacity">
                Jelajah Katalog
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($wishlistedProducts as $product)
            <div class="group relative">
                <a href="{{ route('product.show', $product->slug) }}" class="block">
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
                        </div>
                    </div>
                </a>
                
                <div class="flex items-start justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-primary mb-1 group-hover:text-primary/70 transition-colors">{{ $product->title }}</h3>
                        <p class="text-sm text-secondary">{{ $product->category->name }}</p>
                    </div>
                    
                    {{-- Remove Button (AlpineJS can handle this better, but using form for now) --}}
                    <!-- In a real SPA, this would use the toggle API. Here we just link to product or could add a remove form -->
                </div>
            </div>
            @endforeach
        </div>
    @endif
@endsection
