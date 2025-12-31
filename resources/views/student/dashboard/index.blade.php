{{-- FILE: resources/views/student/dashboard/index.blade.php --}}
@extends('layouts.student')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl font-bold bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent mb-2">Halo, {{ $student->name }}!</h1>
        <p class="text-secondary text-lg">Selamat datang kembali! Mari lanjutkan progres belajarmu hari ini.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        {{-- Total Kursus Diikuti --}}
        <div class="bg-surface border border-border p-6 rounded-xl relative overflow-hidden group hover:border-primary/20 shadow-sm transition-all duration-300">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-blue-500/10 rounded-full blur-2xl group-hover:bg-blue-500/20 transition-colors"></div>
            <h3 class="text-secondary text-xs uppercase tracking-widest font-bold mb-2">Kursus Diikuti</h3>
            <div class="flex items-end gap-2">
                <p class="text-4xl font-bold text-primary font-mono">{{ $totalEnrolledCourses }}</p>
                <span class="text-xs text-blue-500 mb-1">Kelas</span>
            </div>
        </div>

        {{-- Kursus Selesai (100%) --}}
        <div class="bg-surface border border-border p-6 rounded-xl relative overflow-hidden group hover:border-primary/20 shadow-sm transition-all duration-300">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-green-500/10 rounded-full blur-2xl group-hover:bg-green-500/20 transition-colors"></div>
            <h3 class="text-secondary text-xs uppercase tracking-widest font-bold mb-2">Kursus Selesai</h3>
            <div class="flex items-end gap-2">
                <p class="text-4xl font-bold text-primary font-mono">{{ $completedCoursesCount }}</p>
                <span class="text-xs text-green-500 mb-1">Tuntas</span>
            </div>
        </div>

        {{-- Sertifikat Diperoleh --}}
        <div class="bg-surface border border-border p-6 rounded-xl relative overflow-hidden group hover:border-primary/20 shadow-sm transition-all duration-300">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-yellow-500/10 rounded-full blur-2xl group-hover:bg-yellow-500/20 transition-colors"></div>
            <h3 class="text-secondary text-xs uppercase tracking-widest font-bold mb-2">Sertifikat</h3>
            <div class="flex items-end gap-2">
                <p class="text-4xl font-bold text-primary font-mono">{{ $totalCertificates }}</p>
                <span class="text-xs text-yellow-500 mb-1">Penghargaan</span>
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