@extends('layouts.sysadmin')

@section('title', 'Dashboard')

@section('content')
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h2 class="text-3xl font-bold text-primary tracking-tight">Dashboard Sistem</h2>
            <p class="text-secondary mt-1">Ringkasan performa dan aktivitas platform hari ini.</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('sysadmin.manage_course.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-surface border border-border rounded-lg text-sm font-medium text-primary hover:bg-white hover:border-dray-300 transition-all shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                 Kelola Kursus
            </a>
            <a href="{{ route('sysadmin.manage_user.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-background rounded-lg text-sm font-medium hover:bg-primary/90 transition-all shadow-lg hover:shadow-xl">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                 Kelola User
            </a>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Widget 1: Courses -->
        <div class="bg-surface border border-border p-6 rounded-2xl relative overflow-hidden group hover:border-primary/20 shadow-sm transition-all duration-300">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 rounded-xl bg-blue-500/10 flex items-center justify-center text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <span class="text-xs font-medium text-green-500 bg-green-500/10 px-2 py-1 rounded-full">+2.5%</span>
            </div>
            <div class="mb-1">
                <h3 class="text-secondary text-sm font-medium">Total Kursus</h3>
                <p class="text-3xl font-bold text-primary tracking-tight">{{ $contentStats['courses'] }}</p>
            </div>
            <div class="w-full bg-border/50 h-1 rounded-full mt-4 overflow-hidden">
                <div class="bg-blue-500 h-1 rounded-full" style="width: 70%"></div>
            </div>
        </div>

        <!-- Widget 2: Students -->
        <div class="bg-surface border border-border p-6 rounded-2xl relative overflow-hidden group hover:border-primary/20 shadow-sm transition-all duration-300">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 rounded-xl bg-purple-500/10 flex items-center justify-center text-purple-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                 <span class="text-xs font-medium text-green-500 bg-green-500/10 px-2 py-1 rounded-full">+12%</span>
            </div>
             <div class="mb-1">
                <h3 class="text-secondary text-sm font-medium">Total Siswa</h3>
                <p class="text-3xl font-bold text-primary tracking-tight">{{ $userStats['students'] }}</p>
            </div>
            <div class="w-full bg-border/50 h-1 rounded-full mt-4 overflow-hidden">
                <div class="bg-purple-500 h-1 rounded-full" style="width: 85%"></div>
            </div>
        </div>

        <!-- Widget 3: Lecturers -->
        <div class="bg-surface border border-border p-6 rounded-2xl relative overflow-hidden group hover:border-primary/20 shadow-sm transition-all duration-300">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 rounded-xl bg-green-500/10 flex items-center justify-center text-green-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <span class="text-xs font-medium text-secondary bg-secondary/10 px-2 py-1 rounded-full">Stabil</span>
            </div>
            <div class="mb-1">
                <h3 class="text-secondary text-sm font-medium">Total Dosen</h3>
                <p class="text-3xl font-bold text-primary tracking-tight">{{ $userStats['lecturers'] }}</p>
            </div>
             <div class="w-full bg-border/50 h-1 rounded-full mt-4 overflow-hidden">
                <div class="bg-green-500 h-1 rounded-full" style="width: 45%"></div>
            </div>
        </div>

        <!-- Widget 4: Course Admins -->
        <div class="bg-surface border border-border p-6 rounded-2xl relative overflow-hidden group hover:border-primary/20 shadow-sm transition-all duration-300">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 rounded-xl bg-orange-500/10 flex items-center justify-center text-orange-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <span class="text-xs font-medium text-secondary bg-secondary/10 px-2 py-1 rounded-full">Admin</span>
            </div>
            <div class="mb-1">
                <h3 class="text-secondary text-sm font-medium">Course Admin</h3>
                <p class="text-3xl font-bold text-primary tracking-tight">{{ $userStats['course_admins'] }}</p>
            </div>
             <div class="w-full bg-border/50 h-1 rounded-full mt-4 overflow-hidden">
                <div class="bg-orange-500 h-1 rounded-full" style="width: 30%"></div>
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