{{-- FILE: resources/views/course_admin/dashboard/index.blade.php --}}
@extends('layouts.course_admin')
@section('title', 'Dashboard')
@section('content')
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h2 class="text-3xl font-bold text-primary tracking-tight">Dashboard Instruktur</h2>
            <p class="text-secondary mt-1">Kelola materi dan pantau perkembangan siswa Anda.</p>
        </div>
        <div class="flex gap-3">
             <a href="{{ route('course_admin.courses.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-background rounded-lg text-sm font-medium hover:bg-primary/90 transition-all shadow-lg hover:shadow-xl">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                 Buat Kursus Baru
            </a>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <!-- Widget 1: Total Courses -->
        <div class="bg-surface border border-border p-6 rounded-2xl relative overflow-hidden group hover:border-primary/20 shadow-sm transition-all duration-300">
             <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 rounded-xl bg-blue-500/10 flex items-center justify-center text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <span class="text-xs font-medium text-blue-500 bg-blue-500/10 px-2 py-1 rounded-full">Aktif</span>
            </div>
            <div class="mb-1">
                <h3 class="text-secondary text-sm font-medium">Total Kursus Anda</h3>
                <p class="text-3xl font-bold text-primary tracking-tight">{{ $stats['total_courses'] }}</p>
            </div>
             <div class="w-full bg-border/50 h-1 rounded-full mt-4 overflow-hidden">
                <div class="bg-blue-500 h-1 rounded-full" style="width: 60%"></div>
            </div>
        </div>

        <!-- Widget 2: Total Students -->
        <div class="bg-surface border border-border p-6 rounded-2xl relative overflow-hidden group hover:border-primary/20 shadow-sm transition-all duration-300">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 rounded-xl bg-green-500/10 flex items-center justify-center text-green-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <!-- Logic placeholder for growth -->
                <span class="text-xs font-medium text-green-500 bg-green-500/10 px-2 py-1 rounded-full">+5 Siswa Baru</span>
            </div>
            <div class="mb-1">
                <h3 class="text-secondary text-sm font-medium">Total Siswa Terdaftar</h3>
                <p class="text-3xl font-bold text-primary tracking-tight">{{ $stats['total_students'] }}</p>
            </div>
            <div class="w-full bg-border/50 h-1 rounded-full mt-4 overflow-hidden">
                <div class="bg-green-500 h-1 rounded-full" style="width: 75%"></div>
            </div>
        </div>
    </div>

    <!-- Popular Courses Table -->
    <div class="bg-surface border border-border rounded-xl overflow-hidden shadow-sm">
        <div class="p-6 border-b border-border">
            <h3 class="text-primary font-bold flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                </svg>
                Kursus Terpopuler Anda
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-secondary uppercase bg-secondary/5">
                    <tr>
                        <th class="px-6 py-3">Nama Kursus</th>
                        <th class="px-6 py-3">Jumlah Siswa</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    @forelse ($popularCourses as $course)
                        <tr class="hover:bg-primary/5 transition-colors">
                            <td class="px-6 py-4 font-medium text-primary">{{ $course->name }}</td>
                            <td class="px-6 py-4 text-secondary">{{ $course->students_count }} Siswa</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="px-6 py-4 text-center text-secondary">Anda belum memiliki kursus.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection