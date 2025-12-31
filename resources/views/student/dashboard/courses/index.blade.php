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
                        <svg class="w-5 h-5 text-secondary group-focus-within:text-primary transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </span>
                    <input type="search" name="search" value="{{ request('search') }}" placeholder="Cari kursus..." class="w-full pl-10 pr-4 py-2.5 bg-surface border border-border rounded-xl text-primary placeholder-secondary focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none transition-all shadow-sm">
                </div>
            </form>
        </div>
    </div>

    {{-- Tampilkan notifikasi jika ada pencarian --}}
    @isset($searchTerm)
    <div class="bg-surface border border-primary/20 text-primary p-4 mb-8 rounded-xl flex items-center gap-3" role="alert">
        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
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
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $course->courseAdmin->name }}
                        </p>
                        <a href="{{ route('student.courses.show', $course) }}" class="text-xs font-semibold text-primary group-hover:translate-x-1 transition-transform inline-flex items-center">
                            Detail <svg class="w-3.5 h-3.5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
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
                <a href="{{ route('student.courses.index') }}" class="inline-block mt-4 text-sm font-semibold text-primary underline">Lihat semua kursus</a>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $courses->links() }}
    </div>
@endsection