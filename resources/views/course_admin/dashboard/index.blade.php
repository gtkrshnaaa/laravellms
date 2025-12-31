{{-- FILE: resources/views/course_admin/dashboard/index.blade.php --}}
@extends('layouts.course_admin')
@section('title', 'Dashboard')
@section('content')
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-primary mb-2">Halo, {{ auth('course_admin')->user()->name }}!</h2>
        <p class="text-secondary">Selamat datang kembali. Berikut adalah ringkasan aktivitas kursus Anda.</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <!-- Widget 1: Total Courses -->
        <div class="bg-surface border border-border p-6 rounded-xl relative overflow-hidden group hover:border-primary/20 shadow-sm hover:shadow-md transition-all duration-300">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-blue-500/10 rounded-full blur-2xl group-hover:bg-blue-500/20 transition-colors"></div>
            <h3 class="text-secondary text-xs uppercase tracking-widest font-bold mb-2">Total Kursus Anda</h3>
            <div class="flex items-end gap-2">
                <p class="text-4xl font-bold text-primary font-mono">{{ $stats['total_courses'] }}</p>
                <span class="text-xs text-blue-400 mb-1">Kelas</span>
            </div>
        </div>

        <!-- Widget 2: Total Students -->
        <div class="bg-surface border border-border p-6 rounded-xl relative overflow-hidden group hover:border-primary/20 shadow-sm hover:shadow-md transition-all duration-300">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-green-500/10 rounded-full blur-2xl group-hover:bg-green-500/20 transition-colors"></div>
            <h3 class="text-secondary text-xs uppercase tracking-widest font-bold mb-2">Total Siswa</h3>
            <div class="flex items-end gap-2">
                <p class="text-4xl font-bold text-primary font-mono">{{ $stats['total_students'] }}</p>
                <span class="text-xs text-green-400 mb-1">Pendaftar</span>
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