@extends('layouts.student')

@section('title', 'Kursus Saya')

@section('content')
    <h1 class="text-3xl font-bold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-gray-900 to-gray-600 dark:from-white dark:to-gray-400 mb-8">Kursus Saya</h1>

    @if (session('success'))
        <div class="bg-green-500/10 border border-green-500/20 text-green-600 dark:text-green-400 p-4 mb-6 rounded-xl flex items-center gap-2" role="alert">
            <i class="uil uil-check-circle text-xl"></i>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($enrolledCourses as $course)
            @php
                $student = Auth::guard('student')->user();
                $progressPercentage = $course->getProgressPercentageForStudent($student);
            @endphp
            <div class="bg-surface rounded-2xl border border-border overflow-hidden group flex flex-col hover:border-primary/20 transition-all duration-300 shadow-sm hover:shadow-md">
                <a href="{{ route('student.enrolled_course.show', $course) }}" class="relative overflow-hidden aspect-video">
                    <img src="{{ $course->thumbnail ? Storage::url($course->thumbnail) : 'https://placehold.co/600x400/18181b/ffffff?text=Course' }}" alt="{{ $course->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>
                <div class="p-6 flex flex-col flex-grow">
                    <a href="{{ route('student.enrolled_course.show', $course) }}">
                        <h2 class="text-xl font-bold text-primary truncate group-hover:text-transparent group-hover:bg-clip-text group-hover:bg-gradient-to-r group-hover:from-primary group-hover:to-secondary transition-all">{{ $course->name }}</h2>
                    </a>
                    <div class="mt-4">
                        <div class="flex justify-between text-sm text-secondary mb-2">
                            <span>Progres Belajar</span>
                            <span class="font-bold text-primary">{{ $progressPercentage }}%</span>
                        </div>
                        <div class="w-full bg-secondary/10 rounded-full h-2">
                            <div class="bg-gradient-to-r from-blue-600 to-purple-600 h-2 rounded-full transition-all duration-1000 ease-out" style="width: {{ $progressPercentage }}%"></div>
                        </div>
                    </div>
                    
                    <div class="mt-6 pt-4 border-t border-border mt-auto">
                        @if($progressPercentage == 100)
                            <a href="{{ route('student.course.certificate', $course) }}" target="_blank" class="inline-flex justify-center items-center w-full px-4 py-3 rounded-xl bg-green-600 text-white font-bold hover:bg-green-700 transition-all shadow-lg shadow-green-600/20 hover:-translate-y-0.5">
                                <i class="uil uil-award mr-2"></i> Lihat Sertifikat
                            </a>
                        @else
                            <a href="{{ route('student.enrolled_course.show', $course) }}" class="inline-flex justify-center items-center w-full px-4 py-3 rounded-xl bg-primary text-background font-bold hover:bg-primary/90 transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                                Lanjutkan Belajar
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-surface p-12 rounded-2xl border border-dashed border-border text-center">
                <div class="w-20 h-20 bg-secondary/10 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="uil uil-book-open text-4xl text-secondary"></i>
                </div>
                <h3 class="text-xl font-bold text-primary mb-2">Belum Ada Kursus</h3>
                <p class="text-secondary max-w-md mx-auto mb-8">Anda belum mendaftar di kursus manapun. Mulai perjalanan belajar Anda hari ini!</p>
                <a href="{{ route('student.courses.index') }}" class="inline-flex items-center px-6 py-3 rounded-xl bg-primary text-background font-bold hover:bg-primary/90 transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                    <i class="uil uil-search mr-2"></i> Cari Kursus Sekarang
                </a>
            </div>
        @endforelse
    </div>

    <div class="mt-12">
        {{ $enrolledCourses->links() }}
    </div>
@endsection