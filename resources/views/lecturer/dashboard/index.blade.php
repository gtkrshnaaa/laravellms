@extends('layouts.lecturer')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-primary tracking-tight">Dashboard Dosen</h2>
        <p class="text-secondary mt-1">Pantau aktivitas pengajaran dan interaksi dengan mahasiswa.</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <!-- Widget 1: Total Courses -->
        <div class="bg-surface border border-border p-6 rounded-2xl relative overflow-hidden group hover:border-primary/20 shadow-sm transition-all duration-300">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 rounded-xl bg-indigo-500/10 flex items-center justify-center text-indigo-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 13v-1m4 1v-3m4 3V8M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
                </div>
                <span class="text-xs font-medium text-indigo-500 bg-indigo-500/10 px-2 py-1 rounded-full">Aktif</span>
            </div>
            <div class="mb-1">
                <h3 class="text-secondary text-sm font-medium">Total Kursus Diampu</h3>
                <p class="text-3xl font-bold text-primary tracking-tight">{{ $totalCourses }}</p>
            </div>
             <div class="w-full bg-border/50 h-1 rounded-full mt-4 overflow-hidden">
                <div class="bg-indigo-500 h-1 rounded-full" style="width: 55%"></div>
            </div>
        </div>

        <!-- Widget 2: Total Students -->
        <div class="bg-surface border border-border p-6 rounded-2xl relative overflow-hidden group hover:border-primary/20 shadow-sm transition-all duration-300">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 rounded-xl bg-pink-500/10 flex items-center justify-center text-pink-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                 <span class="text-xs font-medium text-pink-500 bg-pink-500/10 px-2 py-1 rounded-full">Total</span>
            </div>
            <div class="mb-1">
                <h3 class="text-secondary text-sm font-medium">Total Mahasiswa</h3>
                <p class="text-3xl font-bold text-primary tracking-tight">{{ $totalStudents }}</p>
            </div>
             <div class="w-full bg-border/50 h-1 rounded-full mt-4 overflow-hidden">
                <div class="bg-pink-500 h-1 rounded-full" style="width: 80%"></div>
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