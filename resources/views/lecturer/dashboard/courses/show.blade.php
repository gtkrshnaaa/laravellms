@extends('layouts.lecturer')

@section('title', 'Detail Kursus: ' . $course->name)

@section('content')
    <a href="{{ route('lecturer.courses.index') }}" class="text-sm text-blue-600 hover:underline mb-4 inline-block">
        <i class="uil uil-arrow-left"></i> Kembali ke Daftar Kursus
    </a>
    <h1 class="text-3xl font-bold text-black mb-2">{{ $course->name }}</h1>
    <p class="text-gray-600 mb-6">Berikut adalah daftar siswa yang terdaftar beserta progres belajar mereka.</p>

    <div class="bg-white rounded-lg border border-blue-100 overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-blue-50">
                <tr>
                    <th class="p-4 font-semibold text-sm text-gray-600">Nama Siswa</th>
                    <th class="p-4 font-semibold text-sm text-gray-600">Email</th>
                    <th class="p-4 font-semibold text-sm text-gray-600">Progres Belajar</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-blue-100">
                @forelse ($students as $student)
                    <tr>
                        <td class="p-4 font-medium text-black">{{ $student->name }}</td>
                        <td class="p-4 text-gray-600">{{ $student->email }}</td>
                        <td class="p-4 text-gray-600">
                            <div class="flex items-center">
                                <div class="w-full bg-blue-100 rounded-full h-2.5 mr-2">
                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $student->progress }}%"></div>
                                </div>
                                <span class="font-semibold text-sm">{{ $student->progress }}%</span>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="p-4 text-center text-gray-600">Belum ada siswa yang mendaftar di kursus ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection