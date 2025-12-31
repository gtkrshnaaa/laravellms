{{-- FILE: resources/views/student/dashboard/index.blade.php --}}
@extends('layouts.student')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl font-bold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-gray-900 to-gray-600 dark:from-white dark:to-gray-400">Halo, {{ $student->name }}!</h1>
        <p class="text-secondary mt-1">Selamat datang kembali! Mari lanjutkan progres belajarmu hari ini.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        {{-- Total Kursus Diikuti --}}
        <div class="relative overflow-hidden p-6 rounded-2xl border border-border group transition-all duration-300 bg-gradient-to-br from-surface to-gray-100 dark:from-surface dark:to-gray-900 shadow-sm hover:shadow-md">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 rounded-xl bg-blue-500/10 flex items-center justify-center text-blue-600 border border-blue-500/20 shadow-sm">
                    <i class="uil uil-book-reader text-xl"></i>
                </div>
                 <span class="text-xs font-medium text-blue-500 bg-blue-500/10 px-2 py-1 rounded-full border border-blue-500/20">Aktif</span>
            </div>
            <div class="mb-1">
                <h3 class="text-secondary text-sm font-medium">Kursus Diikuti</h3>
                <p class="text-3xl font-bold text-primary tracking-tight">{{ $totalEnrolledCourses }}</p>
            </div>
        </div>

        {{-- Kursus Selesai (100%) --}}
        <div class="relative overflow-hidden p-6 rounded-2xl border border-border group transition-all duration-300 bg-gradient-to-br from-surface to-gray-100 dark:from-surface dark:to-gray-900 shadow-sm hover:shadow-md">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 rounded-xl bg-green-500/10 flex items-center justify-center text-green-600 border border-green-500/20 shadow-sm">
                    <i class="uil uil-check-circle text-xl"></i>
                </div>
                 <span class="text-xs font-medium text-green-500 bg-green-500/10 px-2 py-1 rounded-full border border-green-500/20">Selesai</span>
            </div>
            <div class="mb-1">
                <h3 class="text-secondary text-sm font-medium">Kursus Tuntas</h3>
                <p class="text-3xl font-bold text-primary tracking-tight">{{ $completedCoursesCount }}</p>
            </div>
        </div>

        {{-- Sertifikat Diperoleh --}}
        <div class="relative overflow-hidden p-6 rounded-2xl border border-border group transition-all duration-300 bg-gradient-to-br from-surface to-gray-100 dark:from-surface dark:to-gray-900 shadow-sm hover:shadow-md">
             <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 rounded-xl bg-yellow-500/10 flex items-center justify-center text-yellow-600 border border-yellow-500/20 shadow-sm">
                    <i class="uil uil-award text-xl"></i>
                </div>
                 <span class="text-xs font-medium text-yellow-500 bg-yellow-500/10 px-2 py-1 rounded-full border border-yellow-500/20">Prestasi</span>
            </div>
            <div class="mb-1">
                <h3 class="text-secondary text-sm font-medium">Sertifikat</h3>
                <p class="text-3xl font-bold text-primary tracking-tight">{{ $totalCertificates }}</p>
            </div>
        </div>
    </div>

    {{-- Section: Kursus Sedang Berjalan --}}
    <div class="mb-12">
        <h2 class="text-2xl font-bold text-primary mb-6 flex items-center gap-2">
            <span class="w-2 h-8 bg-blue-500 rounded-full"></span>
            Kursus Sedang Berjalan
        </h2>
        
        <div class="grid grid-cols-1 gap-6">
            @forelse($inProgressCourses as $course)
                <div class="bg-surface border border-border p-6 rounded-xl shadow-sm hover:border-primary/30 transition-all group">
                    <div class="flex flex-col md:flex-row gap-6 items-start md:items-center">
                        <img src="{{ $course->thumbnail ? Storage::url($course->thumbnail) : 'https://placehold.co/150x100/3B82F6/FFFFFF?text=Course' }}" 
                             alt="Thumbnail Kursus" 
                             class="w-full md:w-48 h-32 object-cover rounded-lg border border-border group-hover:scale-105 transition-transform duration-500">
                        
                        <div class="flex-1 w-full">
                            <h3 class="font-bold text-xl text-primary mb-2 group-hover:text-blue-500 transition-colors">{{ $course->name }}</h3>
                            <div class="flex justify-between text-sm text-secondary mb-2">
                                <span>Progres Belajar</span>
                                <span class="font-mono">{{ $course->current_progress }}%</span>
                            </div>
                            <div class="w-full bg-border/50 rounded-full h-2.5 overflow-hidden">
                                <div class="bg-blue-600 h-2.5 rounded-full transition-all duration-1000 ease-out relative overflow-hidden" style="width: {{ $course->current_progress }}%">
                                    <div class="absolute top-0 left-0 w-full h-full bg-white/20 animate-pulse"></div>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('student.enrolled_course.show', $course) }}" class="w-full md:w-auto px-6 py-3 rounded-lg bg-primary text-background font-bold hover:bg-primary/90 transition-all text-center whitespace-nowrap shadow-lg hover:shadow-xl hover:-translate-y-1">
                            Lanjutkan
                        </a>
                    </div>
                </div>
            @empty
                <div class="bg-surface border border-border p-12 rounded-xl text-center">
                    <div class="inline-flex p-4 rounded-full bg-secondary/10 mb-4 text-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <p class="text-secondary text-lg mb-4">Tidak ada kursus yang sedang berjalan.</p>
                    <a href="{{ route('student.courses.index') }}" class="inline-block px-6 py-2 rounded-lg border border-primary text-primary font-medium hover:bg-primary hover:text-background transition-colors">
                        Cari Kursus Baru
                    </a>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Section: Kursus Selesai (100%) --}}
    <div>
        <h2 class="text-2xl font-bold text-primary mb-6 flex items-center gap-2">
            <span class="w-2 h-8 bg-green-500 rounded-full"></span>
            Kursus Selesai
        </h2>
        
        <div class="grid grid-cols-1 gap-6">
            @forelse($completedCoursesList as $course)
                <div class="bg-surface border border-border p-6 rounded-xl shadow-sm hover:border-green-500/30 transition-all group">
                    <div class="flex flex-col md:flex-row gap-6 items-start md:items-center">
                        <img src="{{ $course->thumbnail ? Storage::url($course->thumbnail) : 'https://placehold.co/150x100/3B82F6/FFFFFF?text=Course' }}" 
                             alt="Thumbnail Kursus" 
                             class="w-full md:w-48 h-32 object-cover rounded-lg border border-border grayscale group-hover:grayscale-0 transition-all duration-500">
                        
                        <div class="flex-1 w-full">
                            <div class="flex items-center gap-2 mb-2">
                                <h3 class="font-bold text-xl text-primary group-hover:text-green-500 transition-colors">{{ $course->name }}</h3>
                                <span class="px-2 py-0.5 rounded text-xs font-bold bg-green-500/10 text-green-600 border border-green-500/20">SELESAI</span>
                            </div>
                            <p class="text-secondary text-sm mb-3">Selamat! Anda telah menyelesaikan kursus ini.</p>
                            <div class="w-full bg-green-500/10 rounded-full h-2.5">
                                <div class="bg-green-500 h-2.5 rounded-full" style="width: 100%"></div>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                            <a href="{{ route('student.enrolled_course.show', $course) }}" class="px-4 py-2 rounded-lg bg-surface border border-border text-secondary font-medium hover:text-primary hover:border-primary transition-colors text-center text-sm">
                                Review Materi
                            </a>
                            <a href="{{ route('student.course.certificate', $course) }}" target="_blank" class="px-4 py-2 rounded-lg bg-green-500 text-white font-bold hover:bg-green-600 transition-colors text-center text-sm whitespace-nowrap shadow-lg shadow-green-500/20">
                                Lihat Sertifikat
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-surface border border-border p-8 rounded-xl text-center">
                    <p class="text-secondary">Belum ada kursus yang Anda selesaikan. Ayo semangat belajar!</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection