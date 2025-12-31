@extends('layouts.course_admin')
@section('title', 'Pendaftaran Massal')

@section('content')
<div class="space-y-6">
    <div class="sm:flex sm:items-center sm:justify-between">
        <h1 class="text-2xl font-bold text-primary">Batch Enrollment (Pendaftaran Massal)</h1>
        <a href="{{ route('course_admin.management.courses.index') }}" class="mt-4 sm:mt-0 inline-flex items-center px-4 py-2 border border-border rounded-lg shadow-sm text-sm font-medium text-secondary bg-surface hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali
        </a>
    </div>

    <div class="bg-surface shadow rounded-lg border border-border">
        <div class="p-6">
            <form action="{{ route('course_admin.management.batch_enrollment.store') }}" method="POST" class="space-y-6">
                @csrf
                
                {{-- Peringatan Info --}}
                <div class="bg-blue-500/10 border border-blue-500/20 rounded-lg p-4 flex items-start gap-3">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div>
                        <h3 class="text-sm font-medium text-blue-800 dark:text-blue-300">Informasi Pendaftaran Massal</h3>
                        <p class="mt-1 text-sm text-blue-700 dark:text-blue-400">
                            Fitur ini akan mendaftarkan <strong>SEMUA</strong> siswa yang berada dalam Divisi yang dipilih ke Kursus yang dipilih. Siswa yang sudah terdaftar tidak akan didaftarkan ulang (duplikat diabaikan).
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                    {{-- Pilih Kursus --}}
                    <div>
                        <label for="course_id" class="block text-sm font-medium text-secondary">Pilih Kursus</label>
                        <select id="course_id" name="course_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-border focus:outline-none focus:ring-primary focus:border-primary sm:text-sm rounded-md bg-background text-primary" required>
                            <option value="">-- Pilih Kursus --</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Pilih Divisi --}}
                    <div>
                        <label for="division" class="block text-sm font-medium text-secondary">Pilih Divisi / Departemen</label>
                        @if($divisions->isEmpty())
                            <div class="mt-1 p-2 bg-red-500/10 border border-red-500/20 text-red-600 rounded text-sm">
                                Belum ada data Divisi pada database Siswa.
                            </div>
                            <input type="hidden" name="division" value="">
                        @else
                            <select id="division" name="division" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-border focus:outline-none focus:ring-primary focus:border-primary sm:text-sm rounded-md bg-background text-primary" required>
                                <option value="">-- Pilih Divisi --</option>
                                @foreach($divisions as $division)
                                    <option value="{{ $division }}">{{ $division }}</option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                </div>

                <div class="pt-5 border-t border-border flex justify-end">
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary" {{ $divisions->isEmpty() ? 'disabled' : '' }}>
                        <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Proses Pendaftaran Massal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
