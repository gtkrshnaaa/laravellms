@extends('layouts.public')

@section('title', $serviceType->name)

@section('content')
    <!-- Service Header -->
    <section class="pt-32 pb-16 bg-background">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <!-- Status Badge -->
                <div class="mb-6">
                    @if($serviceType->is_open)
                        <span class="inline-block bg-green-500/20 text-green-400 text-sm font-bold px-4 py-2 rounded-full border border-green-500/30">
                            🟢 OPEN - Accepting Orders
                        </span>
                    @else
                        <span class="inline-block bg-red-500/20 text-red-400 text-sm font-bold px-4 py-2 rounded-full border border-red-500/30">
                            🔴 CLOSED - Currently Full
                        </span>
                    @endif
                </div>

                <h1 class="text-4xl md:text-6xl font-bold text-primary mb-6">
                    {{ $serviceType->card_title }}
                </h1>
                <p class="text-xl text-secondary leading-relaxed">
                    {{ $serviceType->card_description }}
                </p>
            </div>
        </div>
    </section>

    <!-- Packages Section -->
    <section class="py-16 bg-background">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-primary text-center mb-12">Pilih Paket</h2>

            @if($packages->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-{{ $packages->count() > 2 ? '3' : '2' }} gap-8 max-w-6xl mx-auto">
                    @foreach($packages as $package)
                    <div class="bg-surface border-2 border-border rounded-2xl p-8 hover:border-primary/50 transition-all duration-300 hover:shadow-2xl hover:shadow-primary/10 flex flex-col">
                        <!-- Package Header -->
                        <div class="mb-6">
                            <h3 class="text-2xl font-bold text-primary mb-2">{{ $package->name }}</h3>
                            @if($package->price)
                                <div class="text-3xl font-bold text-primary mb-1">
                                    Rp {{ number_format($package->price, 0, ',', '.') }}
                                </div>
                            @else
                                <div class="text-3xl font-bold text-green-400 mb-1">
                                    GRATIS
                                </div>
                            @endif
                            @if($package->duration_days)
                                <p class="text-sm text-secondary">
                                    Estimasi: {{ $package->duration_days }} hari kerja
                                </p>
                            @endif
                        </div>

                        <!-- Package Description -->
                        <p class="text-secondary mb-6">{{ $package->description }}</p>

                        <!-- Features -->
                        @if($package->features && count($package->features) > 0)
                        <div class="mb-8 flex-1">
                            <h4 class="font-semibold text-primary mb-3">Yang Kamu Dapat:</h4>
                            <ul class="space-y-2">
                                @foreach($package->features as $feature)
                                <li class="flex items-start gap-2 text-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-green-400 flex-shrink-0 mt-0.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                    </svg>
                                    <span>{{ $feature }}</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <!-- Hosting Badge -->
                        @if($package->includes_hosting)
                        <div class="mb-6">
                            <span class="inline-block bg-primary/10 text-primary text-xs font-bold px-3 py-1 rounded-full border border-primary/20">
                                ✨ Include Hosting 1 Bulan
                            </span>
                        </div>
                        @endif

                        <!-- CTA Button -->
                        @if($serviceType->is_open)
                            @auth('buyer')
                                <a href="{{ route('buyer.service.order.create', $package->slug) }}" 
                                   class="block text-center bg-primary text-background font-bold py-3 px-6 rounded-full hover:opacity-90 transition-opacity">
                                    Pesan Sekarang
                                </a>
                            @else
                                <a href="{{ route('login') }}" 
                                   class="block text-center bg-primary text-background font-bold py-3 px-6 rounded-full hover:opacity-90 transition-opacity">
                                    Login untuk Pesan
                                </a>
                            @endauth
                        @else
                            <button disabled class="block w-full text-center bg-secondary/30 text-secondary font-bold py-3 px-6 rounded-full cursor-not-allowed">
                                Service Closed
                            </button>
                        @endif
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center text-secondary py-12">
                    <p>Belum ada paket yang tersedia untuk layanan ini.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Social Proof "Receipts" (Ongoing Projects) -->
    @if(isset($ongoingOrders) && $ongoingOrders->count() > 0)
    <section class="py-12 bg-surface/50 border-t border-border">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-10">
                    <h2 class="text-2xl font-bold text-primary mb-2">🔥 Currently Cooking</h2>
                    <p class="text-secondary">Project yang lagi kita kerjain real-time. No cap.</p>
                </div>

                <div class="space-y-4">
                    @foreach($ongoingOrders as $order)
                    <div class="bg-background border border-border rounded-xl p-5 flex flex-col md:flex-row items-center gap-6">
                        <!-- Icon -->
                        <div class="w-12 h-12 bg-surface border border-border rounded-full flex items-center justify-center text-primary text-xl shadow-sm flex-shrink-0">
                            👨‍💻
                        </div>

                        <!-- Info -->
                        <div class="flex-1 w-full text-center md:text-left">
                            <h4 class="font-bold text-primary">{{ $order->servicePackage->name }}</h4>
                            <p class="text-xs text-secondary mb-2">Ordered by: <span class="font-mono text-primary">{{ $order->masked_buyer_name }}</span></p>
                            
                            <!-- Progress Bar -->
                            <div class="w-full bg-surface border border-border rounded-full h-3 overflow-hidden relative">
                                <div class="absolute top-0 left-0 h-full bg-gradient-to-r from-blue-500 to-indigo-600 transition-all duration-1000" style="width: {{ $order->progress_percent }}%"></div>
                            </div>
                            <div class="flex justify-between mt-1">
                                <span class="text-[10px] text-secondary">Started {{ $order->created_at->diffForHumans() }}</span>
                                <span class="text-[10px] font-bold text-primary">{{ $order->progress_percent }}% Completed</span>
                            </div>
                        </div>

                        <!-- Status Badge -->
                        <div class="flex-shrink-0">
                             <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-blue-500/10 text-blue-500 border border-blue-500/20 animate-pulse">
                                IN PROGRESS
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Back to Home -->
    <section class="py-12 bg-background">
        <div class="container mx-auto px-4 text-center">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-secondary hover:text-primary transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Kembali ke Home
            </a>
        </div>
    </section>
@endsection
