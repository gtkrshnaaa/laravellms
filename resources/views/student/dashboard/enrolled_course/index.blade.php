@extends('layouts.student')

@section('title', 'Kursus Saya')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Kursus Saya</h1>

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($enrolledCourses as $course)
            @php
                $student = Auth::guard('student')->user();
                $progressPercentage = $course->getProgressPercentageForStudent($student);
            @endphp
            <div class="bg-white rounded-lg border-2 border-gray-100 overflow-hidden group flex flex-col">
                <a href="{{ route('student.enrolled_course.show', $course) }}">
                    <img src="{{ $course->thumbnail ? Storage::url($course->thumbnail) : 'https://placehold.co/600x400/3B82F6/FFFFFF?text=Course' }}" alt="{{ $course->name }}" class="w-full h-48 object-cover group-hover:opacity-80 transition-opacity">
                </a>
                <div class="p-6 flex flex-col flex-grow">
                    <a href="{{ route('student.enrolled_course.show', $course) }}">
                        <h2 class="text-xl font-bold text-gray-800 truncate">{{ $course->name }}</h2>
                    </a>
                    <div class="mt-4">
                        <div class="flex justify-between text-sm text-gray-500 mb-1">
                            <span>Progres</span>
                            <span class="font-bold text-gray-600">{{ $progressPercentage }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-gray-600 h-2.5 rounded-full" style="width: {{ $progressPercentage }}%"></div>
                        </div>
                    </div>
                    {{-- [FIXED] Tombol dipindahkan ke sini --}}
                    <div class="mt-6 pt-4 border-t border-gray-100 mt-auto">
                        @if($progressPercentage == 100)
                            <a href="{{ route('student.course.certificate', $course) }}" target="_blank" class="inline-block w-full text-center px-4 py-3 rounded-lg bg-green-600 text-white font-bold hover:bg-green-700 transition-colors">
                                <i class="uil uil-award"></i> Lihat Sertifikat
                            </a>
                        @else
                            <a href="{{ route('student.enrolled_course.show', $course) }}" class="inline-block w-full text-center px-4 py-3 rounded-lg bg-gray-600 text-white font-bold group-hover:bg-gray-700 transition-colors">
                                Lanjutkan Belajar
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white p-8 rounded-lg border-2 border-gray-100 text-center">
                <p class="text-gray-500">Anda belum mendaftar di kursus manapun.</p>
                <a href="{{ route('student.courses.index') }}" class="mt-4 inline-block px-6 py-2 rounded-lg bg-gray-100 text-gray-800 font-bold hover:bg-gray-200 transition-colors">
                    Cari Kursus Sekarang
                </a>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $enrolledCourses->links() }}
    </div>
@endsection