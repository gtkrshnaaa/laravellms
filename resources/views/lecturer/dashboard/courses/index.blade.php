@extends('layouts.lecturer')

@section('title', 'Kursus Saya')

@section('content')
    <h1 class="text-3xl font-bold text-black mb-6">Kursus Saya</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($courses as $course)
            <div class="bg-white rounded-lg border border-blue-100 overflow-hidden group">
                <img src="{{ $course->thumbnail ? Storage::url($course->thumbnail) : 'https://placehold.co/600x400/3B82F6/FFFFFF?text=Course' }}" alt="{{ $course->name }}" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h2 class="text-xl font-bold text-black truncate">{{ $course->name }}</h2>
                    <p class="text-gray-600 text-sm mt-2">
                        <i class="uil uil-users-alt"></i>
                        {{ $course->students_count }} Siswa Terdaftar
                    </p>
                    <div class="mt-6">
                        <a href="{{ route('lecturer.courses.show', $course) }}" class="inline-block w-full text-center px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-bold transition-colors">
                            Lihat Detail Kelas
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white p-8 rounded-lg border border-blue-100 text-center">
                <p class="text-gray-600">Anda belum di-assign ke kursus manapun.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $courses->links() }}
    </div>
@endsection