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
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
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
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ $course->courseAdmin->name }}
                            </p>
                            <a href="{{ route('course.show.public', $course) }}" class="text-xs font-semibold text-primary group-hover:translate-x-1 transition-transform inline-flex items-center">
                                View <svg class="w-3.5 h-3.5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20 bg-surface border border-border rounded-2xl border-dashed">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-secondary/10 text-secondary mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
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