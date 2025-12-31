{{-- File: resources/views/landingpage/sections/hero.blade.php --}}

@php
    // Data gambar untuk karosel didefinisikan langsung di sini.
    $images = [
        'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=2071&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1519389950473-47ba0277781c?q=80&w=2070&auto=format&fit=crop',
        null, // Ini akan memicu placeholder
        'https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=2070&auto=format&fit=crop',
    ];
@endphp

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="relative w-full my-8" id="carousel-container">
        <div class="overflow-hidden rounded-2xl border border-border shadow-sm">
            <div class="flex transition-transform duration-500 ease-in-out" id="carousel-track">
                
                @foreach ($images as $index => $image)
                    <div class="w-full flex-shrink-0 relative">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent z-10 pointer-events-none"></div>
                        <img 
                            src="{{ $image ?? 'https://placehold.co/1280x384/18181b/ffffff?text=Kelas+Unggulan' }}" 
                            alt="Promosi Kursus {{ $index + 1 }}" 
                            {{-- Tinggi karosel sekarang responsif --}}
                            class="w-full h-56 sm:h-72 md:h-80 lg:h-96 object-cover"
                            onerror="this.onerror=null;this.src='https://placehold.co/1280x384/262626/ededed?text=Gambar+Tidak+Tersedia';"
                        >
                        {{-- Optional Caption --}}
                        <div class="absolute bottom-4 left-4 md:bottom-8 md:left-8 z-20 text-white">
                            <h2 class="text-xl md:text-3xl font-bold tracking-tight">Mulai Karir Profesional Anda</h2>
                            <p class="text-sm md:text-base text-gray-200 mt-1">Belajar dari instruktur terbaik di bidangnya.</p>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>

        <button id="prev-slide" class="absolute top-1/2 left-4 -translate-y-1/2 bg-white/90 backdrop-blur text-black hover:bg-white p-3 rounded-full border border-white/20 shadow-lg transition-all hover:scale-105 z-20 group">
            <svg class="w-6 h-6 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        </button>
        <button id="next-slide" class="absolute top-1/2 right-4 -translate-y-1/2 bg-white/90 backdrop-blur text-black hover:bg-white p-3 rounded-full border border-white/20 shadow-lg transition-all hover:scale-105 z-20 group">
            <svg class="w-6 h-6 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </button>
    </div>
</div>

{{-- Skrip JavaScript tidak berubah --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    if (window.carouselInitialized) return;
    window.carouselInitialized = true;

    const track = document.getElementById('carousel-track');
    if (!track) return;

    const slides = Array.from(track.children);
    if (slides.length === 0) return;

    const nextButton = document.getElementById('next-slide');
    const prevButton = document.getElementById('prev-slide');
    
    let slideWidth = slides[0].getBoundingClientRect().width;
    let currentIndex = 0;

    const updateCarouselPosition = () => {
        track.style.transform = 'translateX(-' + (slideWidth * currentIndex) + 'px)';
    };

    const updateButtons = () => {
        prevButton.style.display = currentIndex === 0 ? 'none' : 'block';
        nextButton.style.display = currentIndex >= slides.length - 1 ? 'none' : 'block';
    };

    nextButton.addEventListener('click', () => {
        if (currentIndex < slides.length - 1) {
            currentIndex++;
            updateCarouselPosition();
            updateButtons();
        }
    });

    prevButton.addEventListener('click', () => {
        if (currentIndex > 0) {
            currentIndex--;
            updateCarouselPosition();
            updateButtons();
        }
    });

    window.addEventListener('resize', () => {
        slideWidth = slides[0].getBoundingClientRect().width;
        updateCarouselPosition();
    });

    updateButtons();
});
</script>