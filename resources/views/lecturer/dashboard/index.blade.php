@extends('layouts.lecturer')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-black">Halo, {{ $lecturer->name }}!</h1>
        <p class="text-gray-600 mt-1">Selamat datang di panel dosen. Berikut adalah ringkasan aktivitas Anda.</p>
    </div>

    {{-- STATISTIK --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-lg border border-blue-100">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-50">
                    <i class="uil uil-notebooks text-2xl text-blue-700"></i>
                </div>
                <div class="ml-4">
                    <p class="text-gray-600">Total Kursus Diampu</p>
                    <p class="text-2xl font-bold text-black">{{ $totalCourses }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg border border-blue-100">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-50">
                    <i class="uil uil-users-alt text-2xl text-blue-700"></i>
                </div>
                <div class="ml-4">
                    <p class="text-gray-600">Total Siswa</p>
                    <p class="text-2xl font-bold text-black">{{ $totalStudents }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- SHORTCUT KURSUS TERBARU --}}
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-black mb-4">Akses Cepat Kursus</h2>
        @forelse($latestCourses as $course)
            <div class="bg-white p-4 rounded-lg border border-blue-100 mb-4 flex items-center justify-between">
                <div class="flex items-center">
                    <img src="{{ $course->thumbnail ? Storage::url($course->thumbnail) : 'https://placehold.co/150x100/3B82F6/FFFFFF?text=Course' }}" alt="{{ $course->name }}" class="w-24 h-16 object-cover rounded-md border border-blue-100">
                    <div class="ml-4">
                        <h3 class="font-bold text-lg text-black">{{ $course->name }}</h3>
                        <p class="text-sm text-gray-600">{{ $course->students_count }} Siswa</p>
                    </div>
                </div>
                <a href="{{ route('lecturer.courses.show', $course) }}" class="px-4 py-2 rounded-lg bg-blue-600 text-white font-bold hover:bg-blue-700 transition-colors">
                    Lihat Kelas
                </a>
            </div>
        @empty
            <div class="bg-white p-6 rounded-lg border border-blue-100 text-center">
                <p class="text-gray-600">Anda belum mengampu kursus apapun.</p>
            </div>
        @endforelse
    </div>
@endsection