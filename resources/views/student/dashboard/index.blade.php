{{-- FILE: resources/views/student/dashboard/index.blade.php --}}
@extends('layouts.student')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-black">Halo, {{ $student->name }}!</h1>
        <p class="text-black mt-1">Selamat datang kembali! Mari lanjutkan progres belajarmu hari ini.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        {{-- Total Kursus Diikuti --}}
        <div class="bg-white p-6 rounded-lg border border-blue-100">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-50">
                    <i class="uil uil-notebooks text-2xl text-blue-600"></i>
                </div>
                <div class="ml-4">
                    <p class="text-gray-600">Kursus Diikuti</p>
                    <p class="text-2xl font-bold text-black">{{ $totalEnrolledCourses }}</p> 
                </div>
            </div>
        </div>
        {{-- Kursus Selesai (100%) --}}
        <div class="bg-white p-6 rounded-lg border border-blue-100">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100">
                    <i class="uil uil-check-circle text-2xl text-green-800"></i>
                </div>
                <div class="ml-4">
                    <p class="text-gray-600">Kursus Selesai</p>
                    <p class="text-2xl font-bold text-black">{{ $completedCoursesCount }}</p> 
                </div>
            </div>
        </div>
        {{-- Sertifikat Diperoleh (masih statis, akan dinamis di tahap selanjutnya) --}}
        <div class="bg-white p-6 rounded-lg border border-blue-100">
             <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100">
                    <i class="uil uil-award text-2xl text-yellow-800"></i>
                </div>
                <div class="ml-4">
                    <p class="text-gray-600">Sertifikat Diperoleh</p>
                    <p class="text-2xl font-bold text-black">{{ $totalCertificates }}</p> 
                </div>
            </div>
        </div>
    </div>

    {{-- Section: Kursus Sedang Berjalan --}}
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-black mb-4">Kursus Sedang Berjalan</h2>
        @forelse($inProgressCourses as $course)
            <div class="bg-white p-6 rounded-lg border border-blue-100 mb-4">
                <div class="flex items-center">
                    <img src="{{ $course->thumbnail ? Storage::url($course->thumbnail) : 'https://placehold.co/150x100/3B82F6/FFFFFF?text=Course' }}" alt="Thumbnail Kursus" class="w-32 h-20 object-cover rounded-md border border-blue-100">
                    <div class="ml-4 flex-1">
                        <h3 class="font-bold text-lg text-black">{{ $course->name }}</h3>
                        <p class="text-sm text-gray-600">Progres: {{ $course->current_progress }}%</p>
                        <div class="w-full bg-blue-100 rounded-full h-2.5 mt-2">
                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $course->current_progress }}%"></div>
                        </div>
                    </div>
                    <a href="{{ route('student.enrolled_course.show', $course) }}" class="ml-4 px-4 py-2 rounded-lg bg-blue-600 text-white font-bold hover:bg-blue-700 transition-colors">
                        Lanjutkan
                    </a>
                </div>
            </div>
        @empty
            <div class="bg-white p-6 rounded-lg border border-blue-100 text-center">
                <p class="text-black">Tidak ada kursus yang sedang berjalan. Mulai kursus baru dari halaman <a href="{{ route('student.courses.index') }}" class="font-bold text-blue-600 hover:underline">Cari Kursus</a>.</p>
            </div>
        @endforelse
    </div>

    {{-- Section: Kursus Selesai (100%) --}}
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-black mb-4">Kursus Selesai</h2>
        @forelse($completedCoursesList as $course)
            <div class="bg-white p-6 rounded-lg border border-blue-100 mb-4">
                <div class="flex items-center">
                    <img src="{{ $course->thumbnail ? Storage::url($course->thumbnail) : 'https://placehold.co/150x100/3B82F6/FFFFFF?text=Course' }}" alt="Thumbnail Kursus" class="w-32 h-20 object-cover rounded-md border border-blue-100">
                    <div class="ml-4 flex-1">
                        <h3 class="font-bold text-lg text-black">{{ $course->name }}</h3>
                        <p class="text-sm text-gray-600">Progres: 100% Selesai!</p>
                        <div class="w-full bg-green-200 rounded-full h-2.5 mt-2"> {{-- Warna hijau untuk 100% --}}
                            <div class="bg-green-600 h-2.5 rounded-full" style="width: 100%"></div>
                        </div>
                    </div>
                    {{-- Tombol untuk lihat kembali atau mungkin unduh sertifikat jika sudah ada --}}
                    <a href="{{ route('student.enrolled_course.show', $course) }}" class="ml-4 px-4 py-2 rounded-lg bg-green-100 text-green-800 font-bold hover:bg-green-200 transition-colors">
                        Lihat Kembali
                    </a>
                    <a href="{{ route('student.course.certificate', $course) }}" target="_blank" class="ml-4 px-4 py-2 rounded-lg bg-green-100 text-green-800 font-bold hover:bg-green-200 transition-colors whitespace-nowrap">
                        <i class="uil uil-award"></i> Lihat Sertifikat
                    </a>
                </div>
            </div>
        @empty
            <div class="bg-white p-6 rounded-lg border border-blue-100 text-center">
                <p class="text-black">Belum ada kursus yang Anda selesaikan. Ayo semangat belajar!</p>
            </div>
        @endforelse
    </div>

@endsection