@extends('layouts.lecturer')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-primary mb-2">Halo, {{ $lecturer->name }}!</h2>
        <p class="text-secondary">Selamat datang di panel dosen. Berikut adalah ringkasan aktivitas Anda.</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <!-- Widget 1: Total Courses -->
        <div class="bg-surface border border-border p-6 rounded-xl relative overflow-hidden group hover:border-primary/20 shadow-sm hover:shadow-md transition-all duration-300">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-blue-500/10 rounded-full blur-2xl group-hover:bg-blue-500/20 transition-colors"></div>
            <h3 class="text-secondary text-xs uppercase tracking-widest font-bold mb-2">Total Kursus Diampu</h3>
            <div class="flex items-end gap-2">
                <p class="text-4xl font-bold text-primary font-mono">{{ $totalCourses }}</p>
                <span class="text-xs text-blue-400 mb-1">Kelas</span>
            </div>
        </div>

        <!-- Widget 2: Total Students -->
        <div class="bg-surface border border-border p-6 rounded-xl relative overflow-hidden group hover:border-primary/20 shadow-sm hover:shadow-md transition-all duration-300">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-purple-500/10 rounded-full blur-2xl group-hover:bg-purple-500/20 transition-colors"></div>
            <h3 class="text-secondary text-xs uppercase tracking-widest font-bold mb-2">Total Siswa</h3>
            <div class="flex items-end gap-2">
                <p class="text-4xl font-bold text-primary font-mono">{{ $totalStudents }}</p>
                <span class="text-xs text-purple-400 mb-1">Mahasiswa</span>
            </div>
        </div>
    </div>

    <!-- Latest Courses List -->
    <div>
        <h2 class="text-xl font-bold text-primary mb-4">Akses Cepat Kursus</h2>
        <div class="space-y-4">
            @forelse($latestCourses as $course)
                <div class="bg-surface border border-border p-4 rounded-xl flex flex-col md:flex-row md:items-center justify-between gap-4 shadow-sm hover:border-primary/30 transition-all">
                    <div class="flex items-center gap-4">
                        <img src="{{ $course->thumbnail ? Storage::url($course->thumbnail) : 'https://placehold.co/150x100/3B82F6/FFFFFF?text=Course' }}" alt="{{ $course->name }}" class="w-24 h-16 object-cover rounded-lg border border-border">
                        <div>
                            <h3 class="font-bold text-lg text-primary">{{ $course->name }}</h3>
                            <p class="text-sm text-secondary">{{ $course->students_count }} Siswa</p>
                        </div>
                    </div>
                    <a href="{{ route('lecturer.courses.show', $course) }}" class="px-5 py-2.5 rounded-lg bg-primary text-background font-medium hover:bg-primary/90 transition-colors text-center text-sm">
                        Lihat Kelas
                    </a>
                </div>
            @empty
                <div class="bg-surface border border-border p-6 rounded-xl text-center">
                    <p class="text-secondary">Anda belum mengampu kursus apapun.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection