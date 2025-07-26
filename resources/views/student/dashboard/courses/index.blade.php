@extends('layouts.student')
@section('title', 'Katalog Kursus')

@section('content')
   <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Katalog Kursus</h1>
        {{-- Form Pencarian --}}
        <div class="w-full max-w-sm">
            <form action="{{ route('student.courses.index') }}" method="GET">
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <i class="uil uil-search text-gray-400"></i>
                    </span>
                    <input type="search" name="search" value="{{ request('search') }}" placeholder="Cari kursus di sini..." class="w-full pl-10 pr-4 py-2 border-2 border-gray-200 rounded-full bg-white focus:border-gray-500 focus:outline-none transition">
                </div>
            </form>
        </div>
    </div>

    {{-- Tampilkan notifikasi jika ada pencarian --}}
    @isset($searchTerm)
    <div class="bg-gray-100 border-l-4 border-gray-500 text-gray-700 p-4 mb-6 rounded-md" role="alert">
        <p>Menampilkan hasil pencarian untuk: <span class="font-bold">"{{ $searchTerm }}"</span>. <a href="{{ route('student.courses.index') }}" class="font-bold underline">Lihat semua kursus</a>.</p>
    </div>
    @endisset
    

    {{-- Bagian Tab Kategori Utama (Dinamis) --}}
    @if($categories->isNotEmpty())
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-4 sm:space-x-8 overflow-x-auto" aria-label="Tabs">
                <a href="{{ route('student.courses.index') }}"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm
                           {{ !$selectedCategory ? 'border-gray-600 text-gray-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    Semua Kategori
                </a>

                @foreach ($categories as $category)
                    <a href="{{ route('student.courses.index', ['category' => $category->slug]) }}"
                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm
                               {{ ($selectedCategory && $selectedCategory->id == $category->id) ? 'border-gray-600 text-gray-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        {{ $category->name }}
                    </a>
                @endforeach
            </nav>
        </div>

        {{-- Bagian Tab Sub-Kategori (Dinamis) --}}
        @if($selectedCategory && $selectedCategory->subCategories->isNotEmpty())
            <div class="py-6 flex items-center space-x-3 overflow-x-auto">
                @foreach ($selectedCategory->subCategories as $subCategory)
                    <a href="{{ route('student.courses.index', ['category' => $selectedCategory->slug, 'subcategory' => $subCategory->slug]) }}"
                        class="px-4 py-2 rounded-full font-semibold text-sm whitespace-nowrap
                               {{ ($selectedSubCategory && $selectedSubCategory->id == $subCategory->id) ? 'bg-gray-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        {{ $subCategory->name }}
                    </a>
                @endforeach
            </div>
        @endif
    @endif
    
    {{-- === Course Grid Responsif === --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
        @forelse ($courses as $course)
            <div class="bg-white rounded-lg border-2 border-gray-100 overflow-hidden group relative">
                @if(in_array($course->id, $enrolledCourseIds))
                    <span class="absolute top-2 right-2 bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-1 rounded-full z-10">
                        Sudah Bergabung
                    </span>
                @endif

                <a href="{{ route('student.courses.show', $course) }}" class="block">
                    <img src="{{ $course->thumbnail ? Storage::url($course->thumbnail) : 'https://placehold.co/600x400/BDBDBD/303030?text=Course' }}" alt="{{ $course->name }}" class="w-full h-48 object-cover group-hover:opacity-80 transition-opacity">
                </a>
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-800 truncate">{{ $course->name }}</h2>
                    <p class="text-gray-500 text-sm mt-1">Oleh {{ $course->courseAdmin->name }}</p>

                    @if($course->subCategory)
                        <p class="text-xs font-semibold bg-gray-100 inline-block px-2 py-0.5 rounded-md text-gray-600 mt-2">{{ $course->subCategory->name }}</p>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-500">Saat ini belum ada kursus yang tersedia untuk kategori ini.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $courses->links() }}
    </div>
@endsection