{{-- File: resources/views/layouts/section/landingpage/courseSection.blade.php --}}

<div class="w-full bg-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Judul dan Deskripsi Section --}}
        <div class="max-w-3xl mb-8">
            <h2 class="text-3xl font-bold text-black">
                Gerbang Anda Menuju Karir Profesional
            </h2>
            <p class="mt-2 text-black">
                Dari layanan kabin premium hingga manajemen perhotelan bintang lima, Laravel mendukung pengembangan karir profesional Anda.
            </p>
        </div>

        {{-- Tampilkan notifikasi jika ada pencarian --}}
        @isset($searchTerm)
        <div class="bg-blue-50 border-l-4 border-blue-500 text-black p-4 mb-6 rounded-md" role="alert">
            <p>Menampilkan hasil pencarian untuk: <span class="font-bold">"{{ $searchTerm }}"</span>. <a href="{{ route('landingpage') }}" class="font-bold underline">Lihat semua kursus</a>.</p>
        </div>
        @endisset

        {{-- Bagian Tab Kategori Utama (Dinamis) --}}
        @if($categories->isNotEmpty())
            <div class="border-b border-blue-100">
                <nav class="-mb-px flex space-x-4 sm:space-x-8 overflow-x-auto" aria-label="Tabs">
                    {{-- PERUBAHAN DI SINI: Tambahkan Tombol "Semua Kategori" --}}
                    <a href="{{ route('landingpage') }}"
                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm
                               {{ !$selectedCategory ? 'border-blue-600 text-blue-600' : 'border-transparent text-black hover:text-blue-600 hover:border-blue-300' }}">
                        Semua Kategori
                    </a>

                    @foreach ($categories as $category)
                        <a href="{{ route('landingpage', ['category' => $category->slug]) }}"
                            class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm
                                   {{ ($selectedCategory && $selectedCategory->id == $category->id) ? 'border-blue-600 text-blue-600' : 'border-transparent text-black hover:text-blue-600 hover:border-blue-300' }}">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </nav>
            </div>

            {{-- Bagian Tab Sub-Kategori (Dinamis) --}}
            @if($selectedCategory && $selectedCategory->subCategories->isNotEmpty())
                <div class="py-6 flex items-center space-x-3 overflow-x-auto">
                    @foreach ($selectedCategory->subCategories as $subCategory)
                        <a href="{{ route('landingpage', ['category' => $selectedCategory->slug, 'subcategory' => $subCategory->slug]) }}"
                            class="px-4 py-2 rounded-full font-semibold text-sm whitespace-nowrap
                                   {{ ($selectedSubCategory && $selectedSubCategory->id == $subCategory->id) ? 'bg-blue-600 text-white' : 'bg-white text-black border border-blue-100 hover:bg-blue-50' }}">
                            {{ $subCategory->name }}
                        </a>
                    @endforeach
                </div>
            @endif
        @endif
        
        {{-- === Course Grid Responsif === --}}
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6 mt-8">
            @forelse ($courses as $course)
                <div class="group">
                    <a href="{{ route('course.show.public', $course) }}" class="block">
                        <div class="border border-blue-100 group-hover:border-blue-600 transition">
                             <img src="{{ $course->thumbnail ? Storage::url($course->thumbnail) : 'https://placehold.co/600x400/3B82F6/FFFFFF?text=Course' }}" alt="{{ $course->name }}" class="w-full h-32 sm:h-40 object-cover">
                         </div>
                     </a>
                    <div class="pt-2">
                        <h3 class="text-sm sm:text-md font-bold text-black truncate-2-lines">
                            <a href="{{ route('course.show.public', $course) }}" class="hover:text-blue-600">{{ $course->name }}</a>
                        </h3>
                        <p class="text-xs text-black mt-1 truncate">Oleh {{ $course->courseAdmin->name }}</p>
                        
                        @if($course->subCategory)
                            <p class="text-xs font-semibold bg-white inline-block px-2 rounded-md text-black border border-blue-100 mt-2">{{ $course->subCategory->name }}</p>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-black">Saat ini belum ada kursus yang tersedia untuk kategori ini.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $courses->links() }}
        </div>
    </div>
</div>

<style>
    .truncate-2-lines {
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        min-height: 2.5rem; /* Disesuaikan agar konsisten */
    }
    @media (min-width: 640px) {
        .truncate-2-lines {
            min-height: 2.8rem; /* Sedikit lebih tinggi untuk font sm:text-md */
        }
    }
</style>