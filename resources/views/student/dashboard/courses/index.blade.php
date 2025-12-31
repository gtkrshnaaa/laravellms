@extends('layouts.student')
@section('title', 'Katalog Kursus')

@section('content')
   <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
        <h1 class="text-3xl font-bold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-gray-900 to-gray-600 dark:from-white dark:to-gray-400">Katalog Kursus</h1>
        {{-- Form Pencarian --}}
        <div class="w-full max-w-md">
            <form action="{{ route('student.courses.index') }}" method="GET">
                <div class="relative group">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i class="uil uil-search text-secondary group-focus-within:text-primary transition-colors"></i>
                    </span>
                    <input type="search" name="search" value="{{ request('search') }}" placeholder="Cari kursus..." class="w-full pl-10 pr-4 py-2.5 bg-surface border border-border rounded-xl text-primary placeholder-secondary focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none transition-all shadow-sm">
                </div>
            </form>
        </div>
    </div>

    {{-- Tampilkan notifikasi jika ada pencarian --}}
    @isset($searchTerm)
    <div class="bg-surface border border-primary/20 text-primary p-4 mb-8 rounded-xl flex items-center gap-3" role="alert">
        <i class="uil uil-search text-xl"></i>
        <p>Menampilkan hasil pencarian untuk: <span class="font-bold">"{{ $searchTerm }}"</span>. <a href="{{ route('student.courses.index') }}" class="font-bold underline hover:text-secondary">Lihat semua kursus</a>.</p>
    </div>
    @endisset
    

    {{-- Bagian Tab Kategori Utama (Dinamis) --}}
    @if($categories->isNotEmpty())
        <div class="border-b border-border mb-8">
            <nav class="-mb-px flex space-x-6 overflow-x-auto no-scrollbar" aria-label="Tabs">
                <a href="{{ route('student.courses.index') }}"
                    class="whitespace-nowrap py-4 border-b-2 font-medium text-sm transition-colors
                           {{ !$selectedCategory ? 'border-primary text-primary' : 'border-transparent text-secondary hover:text-primary hover:border-secondary/50' }}">
                    Semua Kategori
                </a>

                @foreach ($categories as $category)
                    <a href="{{ route('student.courses.index', ['category' => $category->slug]) }}"
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
                    <a href="{{ route('student.courses.index', ['category' => $selectedCategory->slug, 'subcategory' => $subCategory->slug]) }}"
                        class="px-4 py-1.5 rounded-full font-medium text-sm whitespace-nowrap transition-colors border
                               {{ ($selectedSubCategory && $selectedSubCategory->id == $subCategory->id) ? 'bg-primary text-background border-primary' : 'bg-surface text-secondary border-border hover:border-primary hover:text-primary' }}">
                        {{ $subCategory->name }}
                    </a>
                @endforeach
            </div>
        @endif
    @endif
    
    {{-- === Course Grid Responsif === --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($courses as $course)
            <div class="bg-surface border border-border rounded-2xl overflow-hidden group relative hover:border-primary/20 transition-all duration-300 shadow-sm hover:shadow-md">
                @if(in_array($course->id, $enrolledCourseIds))
                    <span class="absolute top-3 right-3 bg-green-500/90 backdrop-blur-sm text-white text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-full z-10 shadow-sm border border-white/10">
                        Sudah Bergabung
                    </span>
                @endif

                <a href="{{ route('student.courses.show', $course) }}" class="block relative overflow-hidden aspect-video">
                    <img src="{{ $course->thumbnail ? Storage::url($course->thumbnail) : 'https://placehold.co/600x400/18181b/ffffff?text=Course' }}" 
                         alt="{{ $course->name }}" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                </a>
                <div class="p-5 flex flex-col h-[calc(100%-rem(200px))]">
                    @if($course->subCategory)
                        <div class="mb-2">
                             <span class="text-[10px] font-bold tracking-wider uppercase text-secondary/70 border border-border px-2 py-0.5 rounded-full">
                                {{ $course->subCategory->name }}
                            </span>
                        </div>
                    @endif

                    <h2 class="text-lg font-bold text-primary mb-2 line-clamp-2 leading-tight group-hover:text-blue-500 transition-colors">
                        <a href="{{ route('student.courses.show', $course) }}">{{ $course->name }}</a>
                    </h2>
                    
                    <div class="mt-auto pt-4 flex items-center justify-between border-t border-border/50">
                        <p class="text-xs text-secondary flex items-center gap-1.5">
                            <i class="uil uil-user-circle text-base"></i>
                            {{ $course->courseAdmin->name }}
                        </p>
                        <a href="{{ route('student.courses.show', $course) }}" class="text-xs font-semibold text-primary group-hover:translate-x-1 transition-transform inline-flex items-center">
                            Detail <i class="uil uil-arrow-right ml-1"></i>
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
                <a href="{{ route('student.courses.index') }}" class="inline-block mt-4 text-sm font-semibold text-primary underline">Lihat semua kursus</a>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $courses->links() }}
    </div>
@endsection