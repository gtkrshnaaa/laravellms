@extends('layouts.lecturer')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Halo, {{ $lecturer->name }}!</h1>
        <p class="text-gray-500 mt-1">Selamat datang di panel dosen. Berikut adalah ringkasan aktivitas Anda.</p>
    </div>

    {{-- STATISTIK --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-lg border-2 border-gray-100">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-gray-100">
                    <i class="uil uil-notebooks text-2xl text-gray-800"></i>
                </div>
                <div class="ml-4">
                    <p class="text-gray-500">Total Kursus Diampu</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $totalCourses }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg border-2 border-gray-100">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100">
                    <i class="uil uil-users-alt text-2xl text-green-800"></i>
                </div>
                <div class="ml-4">
                    <p class="text-gray-500">Total Siswa</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $totalStudents }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- SHORTCUT KURSUS TERBARU --}}
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Akses Cepat Kursus</h2>
        @forelse($latestCourses as $course)
            <div class="bg-white p-4 rounded-lg border-2 border-gray-100 mb-4 flex items-center justify-between">
                <div class="flex items-center">
                    <img src="{{ $course->thumbnail ? Storage::url($course->thumbnail) : 'https://placehold.co/150x100/FEE2E2/DC2626?text=Course' }}" alt="{{ $course->name }}" class="w-24 h-16 object-cover rounded-md border border-gray-100">
                    <div class="ml-4">
                        <h3 class="font-bold text-lg text-gray-800">{{ $course->name }}</h3>
                        <p class="text-sm text-gray-500">{{ $course->students_count }} Siswa</p>
                    </div>
                </div>
                <a href="{{ route('lecturer.courses.show', $course) }}" class="px-4 py-2 rounded-lg bg-gray-100 text-gray-800 font-bold hover:bg-gray-200 transition-colors">
                    Lihat Kelas
                </a>
            </div>
        @empty
            <div class="bg-white p-6 rounded-lg border-2 border-gray-100 text-center">
                <p class="text-gray-500">Anda belum mengampu kursus apapun.</p>
            </div>
        @endforelse
    </div>
@endsection