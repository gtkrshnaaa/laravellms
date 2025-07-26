@extends('layouts.course_admin')
@section('title', 'Assign Dosen')

@section('content')
    <a href="{{ route('course_admin.management.courses.show', $course) }}" class="text-sm text-main-red hover:underline mb-4 inline-block transition duration-200">
        < Kembali ke Kelola Kursus
    </a>
    <h1 class="text-2xl font-bold text-dark-text mb-4">Assign Dosen untuk Kursus: "{{ $course->name }}"</h1>

    <div class="bg-white p-6 rounded-lg shadow-md border border-gray-100">
        <form action="{{ route('course_admin.management.courses.lecturers.store', $course) }}" method="POST">
            @csrf
            <div class="mb-6">
                <label class="block text-dark-text font-medium mb-3">Pilih Dosen Pengampu</label>
                <div class="space-y-3">
                    @forelse ($lecturers as $lecturer)
                        <div class="flex items-center p-2 rounded-md hover:bg-gray-50">
                            <input type="checkbox"
                                   name="lecturers[]"
                                   value="{{ $lecturer->id }}"
                                   id="lecturer-{{ $lecturer->id }}"
                                   class="h-4 w-4 text-main-red focus:ring-main-red border-gray-300 rounded"
                                   {{-- Cek apakah ID dosen ini ada di dalam array dosen yang sudah di-assign --}}
                                   {{ in_array($lecturer->id, $assignedLecturerIds) ? 'checked' : '' }}>
                            <label for="lecturer-{{ $lecturer->id }}" class="ml-3 block text-sm font-medium text-dark-text cursor-pointer">
                                {{ $lecturer->name }}
                            </label>
                        </div>
                    @empty
                        <p class="text-light-text">Tidak ada data dosen yang tersedia. Silakan hubungi System Admin untuk menambahkan dosen baru.</p>
                    @endforelse
                </div>
                @error('lecturers') <p class="text-gray-500 text-sm mt-2">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center">
                <button type="submit" class="bg-main-red hover:bg-dark-red text-white font-bold py-2 px-4 rounded-md transition duration-300">
                    Simpan Perubahan
                </button>
                 <a href="{{ route('course_admin.management.courses.show', $course) }}" class="ml-4 text-light-text hover:text-dark-text transition duration-200">Batal</a>
            </div>
        </form>
    </div>
@endsection