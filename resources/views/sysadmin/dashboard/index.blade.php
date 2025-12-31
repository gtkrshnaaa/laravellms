@extends('layouts.sysadmin')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-primary mb-2">Selamat Datang, {{ auth('sysadmin')->user()->name }}!</h2>
        <p class="text-secondary">Ringkasan performa sistem LMS Anda hari ini.</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Widget 1: Courses -->
        <div class="bg-surface border border-border p-6 rounded-xl relative overflow-hidden group hover:border-primary/20 shadow-sm hover:shadow-md transition-all duration-300">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-blue-500/10 rounded-full blur-2xl group-hover:bg-blue-500/20 transition-colors"></div>
            <h3 class="text-secondary text-xs uppercase tracking-widest font-bold mb-2">Total Kursus</h3>
            <div class="flex items-end gap-2">
                <p class="text-4xl font-bold text-primary font-mono">{{ $contentStats['courses'] }}</p>
                <span class="text-xs text-blue-400 mb-1">Kelas</span>
            </div>
        </div>

        <!-- Widget 2: Students -->
        <div class="bg-surface border border-border p-6 rounded-xl relative overflow-hidden group hover:border-primary/20 shadow-sm hover:shadow-md transition-all duration-300">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-purple-500/10 rounded-full blur-2xl group-hover:bg-purple-500/20 transition-colors"></div>
            <h3 class="text-secondary text-xs uppercase tracking-widest font-bold mb-2">Total Siswa</h3>
            <div class="flex items-end gap-2">
                <p class="text-4xl font-bold text-primary font-mono">{{ $userStats['students'] }}</p>
                <span class="text-xs text-purple-400 mb-1">Akun</span>
            </div>
        </div>

        <!-- Widget 3: Lecturers -->
        <div class="bg-surface border border-border p-6 rounded-xl relative overflow-hidden group hover:border-primary/20 shadow-sm hover:shadow-md transition-all duration-300">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-green-500/10 rounded-full blur-2xl group-hover:bg-green-500/20 transition-colors"></div>
            <h3 class="text-secondary text-xs uppercase tracking-widest font-bold mb-2">Total Dosen</h3>
            <div class="flex items-end gap-2">
                <p class="text-4xl font-bold text-primary font-mono">{{ $userStats['lecturers'] }}</p>
                <span class="text-xs text-green-400 mb-1">Pengajar</span>
            </div>
        </div>

        <!-- Widget 4: Course Admins -->
        <div class="bg-surface border border-border p-6 rounded-xl relative overflow-hidden group hover:border-primary/20 shadow-sm hover:shadow-md transition-all duration-300">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-red-500/10 rounded-full blur-2xl group-hover:bg-red-500/20 transition-colors"></div>
            <h3 class="text-secondary text-xs uppercase tracking-widest font-bold mb-2">Course Admin</h3>
            <div class="flex items-end gap-2">
                <p class="text-4xl font-bold text-primary font-mono">{{ $userStats['course_admins'] }}</p>
                <span class="text-xs text-red-500 mb-1">Staff</span>
            </div>
        </div>
    </div>

    <!-- Recent Students Table -->
    <div class="bg-surface border border-border rounded-xl overflow-hidden shadow-sm">
        <div class="p-6 border-b border-border flex justify-between items-center">
            <h3 class="text-primary font-bold flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                Siswa Baru Terdaftar
            </h3>
            <a href="{{ route('sysadmin.manage_student.index') }}" class="text-sm font-medium text-blue-500 hover:text-blue-400 transition-colors">Lihat Semua &rarr;</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-secondary uppercase bg-secondary/5">
                    <tr>
                        <th class="px-6 py-3">Nama Siswa</th>
                        <th class="px-6 py-3">Email</th>
                        <th class="px-6 py-3">Terdaftar Sejak</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    @forelse ($recentActivities['latest_students'] as $student)
                    <tr class="hover:bg-primary/5 transition-colors">
                        <td class="px-6 py-4 font-medium text-primary">{{ $student->name }}</td>
                        <td class="px-6 py-4 text-secondary">{{ $student->email }}</td>
                        <td class="px-6 py-4 text-secondary font-mono text-xs">{{ $student->created_at->diffForHumans() }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-center text-secondary">Belum ada siswa baru.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection