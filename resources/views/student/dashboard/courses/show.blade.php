@extends('layouts.student')

@section('title', $course->name)

@section('content')
{{-- Hero Section ala halaman publik, tapi di dalam layout student --}}
<div class="bg-gray-800 text-white py-8 -m-8 mb-8 px-8">
    <h1 class="text-3xl font-bold">{{ $course->name }}</h1>
    <p class="text-lg mt-2 text-gray-300 max-w-3xl">{{ Str::limit($course->description, 150) }}</p>
    <p class="text-sm mt-3">Dibuat oleh <span class="font-semibold">{{ $course->courseAdmin->name }}</span></p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    {{-- Kolom Konten Utama (Kiri) --}}
    <div class="lg:col-span-2">
        <div class="bg-white p-6 border-2 border-gray-100 rounded-lg">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Deskripsi Lengkap</h2>
            <p class="text-gray-600 leading-relaxed">
                {{ $course->description }}
            </p>
        </div>

        <div class="mt-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Kurikulum Kursus</h2>
            <div class="space-y-3">
                @forelse($course->topics as $topic)
                    <div class="border-2 border-gray-100 rounded-lg overflow-hidden">
                        <div class="p-4 bg-gray-50 border-b-2 border-gray-100">
                            <span class="font-bold text-gray-700">{{ $topic->order }}. {{ $topic->title }}</span>
                        </div>
                        <div class="p-4 bg-white">
                            <ul class="space-y-2">
                                @php
                                    $materials = $topic->videos
                                        ->concat($topic->quizzes)
                                        ->concat($topic->googleDriveMaterials)
                                        ->sortBy('order');
                                @endphp
                                @forelse ($materials as $material)
                                <li class="flex items-center text-gray-600">
                                    <i class="uil {{ $material instanceof \App\Models\Video ? 'uil-video' : 'uil-file-question-alt' }} mr-2 text-gray-400"></i>
                                    <span>{{ $material->title }}</span>
                                </li>
                                @empty
                                <li class="text-gray-500">Belum ada materi untuk topik ini.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">Kurikulum belum tersedia.</p>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Kolom Sticky CTA (Kanan) --}}
    <div class="lg:col-span-1">
        <div class="sticky top-24">
            <div class="bg-white rounded-lg border-2 border-gray-100 overflow-hidden">
                <img src="{{ $course->thumbnail ? Storage::url($course->thumbnail) : 'https://placehold.co/600x400/3B82F6/FFFFFF?text=Course' }}" alt="{{ $course->name }}" class="w-full h-48 object-cover">
                <div class="p-6">
                    @if($isEnrolled)
                        {{-- 1. Jika sudah terdaftar --}}
                        <a href="{{ route('student.enrolled_course.show', $course) }}" class="block w-full text-center p-3 rounded-lg bg-gray-800 text-white font-bold hover:bg-gray-900 transition-colors">
                            Lanjutkan Belajar
                        </a>
                    @else
                        {{-- 2. Jika belum terdaftar --}}
                        <form action="{{ route('student.courses.enroll', $course) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full p-3 rounded-lg bg-gray-600 text-white font-bold hover:bg-gray-700 transition-colors">
                                Daftar Sekarang
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>
@endsection