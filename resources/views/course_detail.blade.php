@extends('layouts.app')

@section('title', $course->name)

@section('content')
<div class="bg-gray-800 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold">{{ $course->name }}</h1>
        <p class="text-xl mt-2 text-gray-300 max-w-3xl">{{ $course->description }}</p>
        <p class="text-sm mt-4">Dibuat oleh <span class="font-semibold">{{ $course->courseAdmin->name }}</span></p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        {{-- Kolom Konten Utama (Kiri) --}}
        <div class="lg:col-span-2">
            <div class="bg-white p-6 border-2 border-gray-100 rounded-lg">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Apa yang akan Anda dapat</h2>
                <ul class="list-disc list-inside space-y-2 text-gray-600">
                    {{-- Placeholder, bisa diisi dari data kursus nanti --}}
                    <li>Materi berupa video yang dibuat kusus untuk mempermudah pemahaman anda.</li>
                    <li>Kuis-kuis yang disusun untuk melatih dan mengasah pemahaman anda.</li>
                    <li>Akses selamanya untuk materi-materi dalam kelas ini.</li>
                </ul>
            </div>

            <div class="mt-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Kurikulum Kursus</h2>
                <div class="space-y-3">
                    @forelse($course->topics as $topic)
                        <div class="border-2 border-gray-100 rounded-lg overflow-hidden">
                            {{-- Judul Topik --}}
                            <div class="p-4 bg-gray-50 border-b-2 border-gray-100">
                                <span class="font-bold text-gray-700">{{ $topic->order }}. {{ $topic->title }}</span>
                            </div>
                            {{-- Konten Topik (selalu terlihat) --}}
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
                    <img src="{{ $course->thumbnail ? Storage::url($course->thumbnail) : 'https://placehold.co/600x400/BDBDBD/303030?text=Course' }}" alt="{{ $course->name }}" class="w-full h-48 object-cover">
                    <div class="p-6">
                        {{-- Tombol Aksi Dinamis --}}
                        @auth('student')
                            @if($isEnrolled)
                                <a href="{{ route('student.enrolled_course.show', $course) }}" class="block w-full text-center p-3 rounded-lg bg-gray-800 text-white font-bold hover:bg-gray-900 transition-colors">
                                    Lanjutkan Belajar
                                </a>
                            @else
                                <form action="{{ route('student.courses.enroll', $course) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full p-3 rounded-lg bg-gray-600 text-white font-bold hover:bg-gray-700 transition-colors">
                                        Daftar Sekarang
                                    </button>
                                </form>
                            @endif
                        @else
                            <a href="{{ route('student.login') }}?redirect={{ url()->current() }}" class="block w-full text-center p-3 rounded-lg bg-gray-600 text-white font-bold hover:bg-gray-700 transition-colors">
                                Login untuk Mendaftar
                            </a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection