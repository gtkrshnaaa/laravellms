@extends('layouts.sysadmin')

@section('title', 'Dashboard')

@section('content')
    <h1 class="text-2xl font-bold mb-1 text-black">Selamat Datang, {{ auth('sysadmin')->user()->name }}!</h1>
    <p class="text-gray-600 mb-6">Berikut adalah ringkasan data dari seluruh sistem LMS.</p>

    {{-- STATISTIK UTAMA --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-white p-6 rounded-lg border border-blue-100">
            <h3 class="text-sm font-medium text-gray-600">Total Kursus</h3>
            <p class="text-3xl font-bold text-black mt-1">{{ $contentStats['courses'] }}</p>
            <p class="text-xs text-gray-600 mt-1">Tersedia untuk dipelajari</p>
        </div>
        <div class="bg-white p-6 rounded-lg border border-blue-100">
            <h3 class="text-sm font-medium text-gray-600">Total Siswa</h3>
            <p class="text-3xl font-bold text-black mt-1">{{ $userStats['students'] }}</p>
            <p class="text-xs text-gray-600 mt-1">Akun terdaftar</p>
        </div>
        <div class="bg-white p-6 rounded-lg border border-blue-100">
            <h3 class="text-sm font-medium text-gray-600">Total Dosen</h3>
            <p class="text-3xl font-bold text-black mt-1">{{ $userStats['lecturers'] }}</p>
            <p class="text-xs text-gray-600 mt-1">Akun terdaftar</p>
        </div>
         <div class="bg-white p-6 rounded-lg border border-blue-100">
            <h3 class="text-sm font-medium text-gray-600">Total Course Admin</h3>
            <p class="text-3xl font-bold text-black mt-1">{{ $userStats['course_admins'] }}</p>
            <p class="text-xs text-gray-600 mt-1">Akun terdaftar</p>
        </div>
    </div>

    {{-- Siswa Baru --}}
    <div>
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-black">Siswa Baru Terdaftar</h2>
            <a href="{{ route('sysadmin.manage_student.index') }}" class="text-sm font-medium text-blue-600 hover:underline">Lihat Semua</a>
        </div>
        <div class="bg-white rounded-lg border border-blue-100">
            <ul class="divide-y divide-blue-100">
                @forelse ($recentActivities['latest_students'] as $student)
                    <li class="p-4 flex justify-between items-center">
                        <div>
                            <p class="font-semibold text-black">{{ $student->name }}</p>
                            <p class="text-sm text-gray-600">{{ $student->email }}</p>
                        </div>
                        <p class="text-sm text-gray-600">{{ $student->created_at->diffForHumans() }}</p>
                    </li>
                @empty
                    <li class="p-4 text-center text-gray-600">Belum ada siswa baru.</li>
                @endforelse
            </ul>
        </div>
    </div>
@endsection