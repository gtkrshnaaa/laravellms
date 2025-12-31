@extends('layouts.public')

@section('title', 'Portfolio - One Day Ez')

@section('content')
<div class="py-20 bg-background min-h-screen">
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="text-center mb-16" data-aos="fade-up">
            <h1 class="text-4xl md:text-5xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-primary via-purple-400 to-primary mb-4 animate-gradient">
                Our Masterpieces
            </h1>
            <p class="text-secondary text-lg max-w-2xl mx-auto">
                Koleksi hasil karya yang kami banggakan. Bukan sekadar kode, tapi solusi yang berdampak.
            </p>
        </div>

        <!-- Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($portfolios as $portfolio)
            <div class="group bg-surface border border-border rounded-2xl overflow-hidden hover:border-primary/50 transition-all duration-300 hover:shadow-glow" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <!-- Image -->
                <div class="relative aspect-video overflow-hidden">
                    @if($portfolio->image_path)
                        <img src="{{ Storage::url($portfolio->image_path) }}" alt="{{ $portfolio->title }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full bg-background border-b border-border flex items-center justify-center text-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 opacity-50">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>
                        </div>
                    @endif
                    
                    <!-- Overlay Tech Stack -->
                    <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/80 to-transparent">
                        <div class="flex flex-wrap gap-2">
                            @foreach($portfolio->tech_stack ?? [] as $tech)
                                <span class="px-2 py-1 rounded-md text-[10px] font-bold bg-primary/20 text-primary border border-primary/30 backdrop-blur-sm">
                                    {{ $tech }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- content -->
                <div class="p-6">
                    <h3 class="text-xl font-bold text-primary mb-2 group-hover:text-primary transition-colors">
                        {{ $portfolio->title }}
                    </h3>
                    <p class="text-secondary text-sm mb-6 line-clamp-3">
                        {{ $portfolio->description }}
                    </p>

                    @if($portfolio->demo_url)
                    <a href="{{ $portfolio->demo_url }}" target="_blank" class="inline-flex items-center gap-2 text-sm font-bold text-primary hover:text-white transition-colors">
                        View Demo
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                        </svg>
                    </a>
                    @else
                    <span class="text-sm font-bold text-secondary cursor-not-allowed opacity-50">
                        Private Project
                    </span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
