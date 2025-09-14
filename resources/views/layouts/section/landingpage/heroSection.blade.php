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
        <div class="overflow-hidden rounded-lg border-2 border-blue-100">
            <div class="flex transition-transform duration-500 ease-in-out" id="carousel-track">
                
                @foreach ($images as $index => $image)
                    <div class="w-full flex-shrink-0">
                        <img 
                            src="{{ $image ?? 'https://placehold.co/1280x384/3B82F6/FFFFFF?text=Kelas+Unggulan' }}" 
                            alt="Promosi Kursus {{ $index + 1 }}" 
                            {{-- Tinggi karosel sekarang responsif --}}
                            class="w-full h-56 sm:h-72 md:h-80 lg:h-96 object-cover"
                            onerror="this.onerror=null;this.src='https://placehold.co/1280x384/DBEAFE/1E3A8A?text=Gambar+Tidak+Tersedia';"
                        >
                    </div>
                @endforeach

            </div>
        </div>

        <button id="prev-slide" class="absolute top-1/2 left-2 sm:left-4 -translate-y-1/2 bg-white/80 hover:bg-white p-2 rounded-full border-2 border-blue-100 transition">
            <i class="uil uil-angle-left-b text-xl sm:text-2xl"></i>
        </button>
        <button id="next-slide" class="absolute top-1/2 right-2 sm:right-4 -translate-y-1/2 bg-white/80 hover:bg-white p-2 rounded-full border-2 border-blue-100 transition">
            <i class="uil uil-angle-right-b text-xl sm:text-2xl"></i>
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