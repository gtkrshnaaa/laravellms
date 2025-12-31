@extends('layouts.lecturer')

@section('title', 'Detail Kursus: ' . $course->name)

@section('content')
    <a href="{{ route('lecturer.courses.index') }}" class="text-sm text-blue-600 hover:underline mb-4 inline-block">
        <i class="uil uil-arrow-left"></i> Kembali ke Daftar Kursus
    </a>
    <h1 class="text-3xl font-bold text-primary mb-2">{{ $course->name }}</h1>
    <p class="text-secondary mb-6">Berikut adalah daftar siswa yang terdaftar beserta progres belajar mereka.</p>

    <div class="bg-surface rounded-lg border border-border overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-secondary/5">
                <tr>
                    <th class="p-4 font-semibold text-sm text-secondary">Nama Siswa</th>
                    <th class="p-4 font-semibold text-sm text-secondary">Email</th>
                    <th class="p-4 font-semibold text-sm text-secondary">Progres Belajar</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border">
                @forelse ($students as $student)
                    <tr>
                        <td class="p-4 font-medium text-primary">{{ $student->name }}</td>
                        <td class="p-4 text-secondary">{{ $student->email }}</td>
                        <td class="p-4 text-secondary">
                            <div class="flex items-center">
                                <div class="w-full bg-secondary/10 rounded-full h-2.5 mr-2">
                                    <div class="bg-primary h-2.5 rounded-full" style="width: {{ $student->progress }}%"></div>
                                </div>
                                <span class="font-semibold text-sm text-primary">{{ $student->progress }}%</span>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="p-4 text-center text-secondary">Belum ada siswa yang mendaftar di kursus ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection