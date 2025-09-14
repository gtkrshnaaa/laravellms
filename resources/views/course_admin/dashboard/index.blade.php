{{-- FILE: resources/views/course_admin/dashboard/index.blade.php --}}
@extends('layouts.course_admin')
@section('title', 'Dashboard')
@section('content')
    <h1 class="text-3xl font-bold text-black mb-1">Halo, {{ auth('course_admin')->user()->name }}!</h1>
    <p class="text-gray-600 mb-6">Selamat datang kembali. Berikut adalah ringkasan aktivitas kursus Anda.</p>

    {{-- STATISTIK UTAMA --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        {{-- Total Kursus --}}
        <div class="bg-white p-6 rounded-lg border border-blue-100 flex items-center">
            <div class="p-3 rounded-full bg-blue-50">
                <i class="uil uil-notebooks text-2xl text-blue-600"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-600">Total Kursus Anda</p>
                <p class="text-2xl font-bold text-black">{{ $stats['total_courses'] }}</p>
            </div>
        </div>
        {{-- Total Siswa --}}
        <div class="bg-white p-6 rounded-lg border border-blue-100 flex items-center">
            <div class="p-3 rounded-full bg-green-100">
                <i class="uil uil-users-alt text-2xl text-green-800"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-600">Total Siswa</p>
                <p class="text-2xl font-bold text-black">{{ $stats['total_students'] }}</p>
            </div>
        </div>
    </div>

    {{-- AKTIVITAS & KURSUS POPULER --}}
    <div>
        <h2 class="text-xl font-bold text-black mb-4">Kursus Terpopuler Anda</h2>
        <div class="bg-white rounded-lg border border-blue-100 overflow-hidden">
            <table class="w-full">
                <thead class="bg-blue-50">
                    <tr>
                        <th class="p-4 text-left text-sm font-semibold text-gray-600">Nama Kursus</th>
                        <th class="p-4 text-left text-sm font-semibold text-gray-600">Jumlah Siswa</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-blue-100">
                    @forelse ($popularCourses as $course)
                        <tr>
                            <td class="p-4 font-medium text-black">{{ $course->name }}</td>
                            <td class="p-4 text-gray-600">{{ $course->students_count }} Siswa</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="p-4 text-center text-gray-600">Anda belum memiliki kursus.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection