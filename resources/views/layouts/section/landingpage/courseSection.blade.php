{{-- File: resources/views/layouts/section/landingpage/courseSection.blade.php --}}

<div class="w-full bg-background py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Judul dan Deskripsi Section --}}
        <div class="max-w-3xl mb-10">
            <h2 class="text-3xl md:text-4xl font-bold text-primary tracking-tight">
                Gerbang Anda Menuju Karir Profesional
            </h2>
            <p class="mt-4 text-secondary text-lg leading-relaxed">
                Dari layanan kabin premium hingga manajemen perhotelan bintang lima, kami mendukung pengembangan karir Anda.
            </p>
        </div>

        {{-- Tampilkan notifikasi jika ada pencarian --}}
        @isset($searchTerm)
        <div class="bg-surface border border-primary/20 text-primary p-4 mb-8 rounded-lg flex items-center gap-3" role="alert">
            <i class="uil uil-search text-xl"></i>
            <p>Menampilkan hasil pencarian untuk: <span class="font-bold">"{{ $searchTerm }}"</span>. <a href="{{ route('landingpage') }}" class="font-bold underline hover:text-secondary">Lihat semua kursus</a>.</p>
        </div>
        @endisset

        {{-- Bagian Tab Kategori Utama (Dinamis) --}}
        @if($categories->isNotEmpty())
            <div class="border-b border-border mb-8">
                <nav class="-mb-px flex space-x-6 overflow-x-auto no-scrollbar" aria-label="Tabs">
                    <a href="{{ route('landingpage') }}"
                        class="whitespace-nowrap py-4 border-b-2 font-medium text-sm transition-colors
                               {{ !$selectedCategory ? 'border-primary text-primary' : 'border-transparent text-secondary hover:text-primary hover:border-secondary/50' }}">
                        Semua Kategori
                    </a>

                    @foreach ($categories as $category)
                        <a href="{{ route('landingpage', ['category' => $category->slug]) }}"
                            class="whitespace-nowrap py-4 border-b-2 font-medium text-sm transition-colors
                                   {{ ($selectedCategory && $selectedCategory->id == $category->id) ? 'border-primary text-primary' : 'border-transparent text-secondary hover:text-primary hover:border-secondary/50' }}">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </nav>
            </div>

            {{-- Bagian Tab Sub-Kategori (Dinamis) --}}
            @if($selectedCategory && $selectedCategory->subCategories->isNotEmpty())
                <div class="flex items-center gap-3 overflow-x-auto pb-8 no-scrollbar">
                    @foreach ($selectedCategory->subCategories as $subCategory)
                        <a href="{{ route('landingpage', ['category' => $selectedCategory->slug, 'subcategory' => $subCategory->slug]) }}"
                            class="px-4 py-1.5 rounded-full font-medium text-sm whitespace-nowrap transition-colors border
                                   {{ ($selectedSubCategory && $selectedSubCategory->id == $subCategory->id) ? 'bg-primary text-background border-primary' : 'bg-surface text-secondary border-border hover:border-primary hover:text-primary' }}">
                            {{ $subCategory->name }}
                        </a>
                    @endforeach
                </div>
            @endif
        @endif
        
        {{-- === Course Grid Responsif === --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse ($courses as $course)
                <div class="group bg-surface border border-border rounded-2xl overflow-hidden hover:border-primary/20 transition-all duration-300 flex flex-col h-full shadow-sm">
                    <a href="{{ route('course.show.public', $course) }}" class="block relative overflow-hidden aspect-video">
                        <img src="{{ $course->thumbnail ? Storage::url($course->thumbnail) : 'https://placehold.co/600x400/18181b/ffffff?text=Course' }}" 
                             alt="{{ $course->name }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                     </a>
                    <div class="p-5 flex flex-col flex-grow">
                        @if($course->subCategory)
                            <div class="mb-2">
                                <span class="text-[10px] font-bold tracking-wider uppercase text-secondary/70 border border-border px-2 py-0.5 rounded-full">
                                    {{ $course->subCategory->name }}
                                </span>
                            </div>
                        @endif

                        <h3 class="text-base font-bold text-primary mb-2 line-clamp-2 leading-tight">
                            <a href="{{ route('course.show.public', $course) }}" class="hover:underline">{{ $course->name }}</a>
                        </h3>
                        
                        <div class="mt-auto pt-4 flex items-center justify-between border-t border-border/50">
                            <p class="text-xs text-secondary flex items-center gap-1.5">
                                <i class="uil uil-user-circle text-base"></i>
                                {{ $course->courseAdmin->name }}
                            </p>
                            <a href="{{ route('course.show.public', $course) }}" class="text-xs font-semibold text-primary group-hover:translate-x-1 transition-transform inline-flex items-center">
                                View <i class="uil uil-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20 bg-surface border border-border rounded-2xl border-dashed">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-secondary/10 text-secondary mb-4">
                        <i class="uil uil-book-open text-3xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-primary">Tidak ada kursus ditemukan</h3>
                    <p class="text-secondary mt-1 max-w-sm mx-auto">Kami belum memiliki kursus untuk kategori atau kata kunci ini.</p>
                    <a href="{{ route('landingpage') }}" class="inline-block mt-4 text-sm font-semibold text-primary underline">Lihat semua kursus</a>
                </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $courses->links() }}
        </div>
    </div>
</div>