@extends('layouts.public')

@section('title', 'Layanan Kami')

@section('content')
    <!-- Header -->
    <section class="pt-32 pb-16 bg-background">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl">
                <h1 class="text-4xl md:text-6xl font-bold text-primary mb-6">
                    Layanan <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500">Professional</span>
                </h1>
                <p class="text-xl text-secondary leading-relaxed">
                    Solusi digital lengkap untuk kebutuhan akademik dan bisnis kamu. Dari web development hingga konsultasi gratis.
                </p>
            </div>
        </div>
    </section>

    <!-- Service List -->
    @if($serviceTypes->count() > 0)
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
                            @else
                            <div class="inline-flex items-center gap-2 bg-red-500/10 border border-red-500/30 text-red-400 text-xs font-bold px-3 py-1.5 rounded-full mb-4">
                                <span class="w-2 h-2 bg-red-400 rounded-full"></span>
                                CURRENTLY FULL
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
    @else
        <section class="py-20 bg-background">
            <div class="container mx-auto px-4">
                <div class="bg-surface border border-border rounded-xl p-12 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 text-secondary mx-auto mb-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z" />
                    </svg>
                    <h3 class="text-xl font-bold text-primary mb-2">Belum Ada Layanan</h3>
                    <p class="text-secondary">Layanan akan segera tersedia. Stay tuned!</p>
                </div>
            </div>
        </section>
    @endif
@endsection
