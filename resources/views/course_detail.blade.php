@extends('layouts.app')

@section('title', $course->name)

@section('content')
<div class="bg-white py-10 border-b border-blue-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold text-black">{{ $course->name }}</h1>
        <p class="text-lg mt-2 text-black max-w-3xl">{{ $course->description }}</p>
        <p class="text-sm mt-4 text-black">Dibuat oleh <span class="font-semibold">{{ $course->courseAdmin->name }}</span></p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        {{-- Kolom Konten Utama (Kiri) --}}
        <div class="lg:col-span-2">
            <div class="bg-white p-6 border border-blue-100 rounded-lg">
                <h2 class="text-2xl font-bold text-black mb-4 border-l-4 border-blue-600 pl-3">Apa yang akan Anda dapat</h2>
                <ul class="list-disc list-inside space-y-2 text-black">
                    {{-- Placeholder, bisa diisi dari data kursus nanti --}}
                    <li>Materi berupa video yang dibuat kusus untuk mempermudah pemahaman anda.</li>
                    <li>Kuis-kuis yang disusun untuk melatih dan mengasah pemahaman anda.</li>
                    <li>Akses selamanya untuk materi-materi dalam kelas ini.</li>
                </ul>
            </div>

            <div class="mt-8">
                <h2 class="text-2xl font-bold text-black mb-4 border-l-4 border-blue-600 pl-3">Kurikulum Kursus</h2>
                <div class="space-y-3">
                    @forelse($course->topics as $topic)
                        <div class="border border-blue-100 rounded-lg overflow-hidden">
                            {{-- Judul Topik --}}
                            <div class="p-4 bg-blue-50 border-b border-blue-100">
                                <span class="font-bold text-black">{{ $topic->order }}. {{ $topic->title }}</span>
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
                                    <li class="flex items-center text-black">
                                        <i class="uil {{ $material instanceof \App\Models\Video ? 'uil-video' : 'uil-file-question-alt' }} mr-2 text-blue-500"></i>
                                        <span>{{ $material->title }}</span>
                                    </li>
                                    @empty
                                    <li class="text-black">Belum ada materi untuk topik ini.</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    @empty
                        <p class="text-black">Kurikulum belum tersedia.</p>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Kolom Sticky CTA (Kanan) --}}
        <div class="lg:col-span-1">
            <div class="sticky top-24">
                <div class="bg-white rounded-lg border border-blue-100 overflow-hidden">
                    <img src="{{ $course->thumbnail ? Storage::url($course->thumbnail) : 'https://placehold.co/600x400/3B82F6/FFFFFF?text=Course' }}" alt="{{ $course->name }}" class="w-full h-48 object-cover">
                    <div class="p-6">
                        {{-- Tombol Aksi Dinamis --}}
                        @auth('student')
                            @if($isEnrolled)
                                <a href="{{ route('student.enrolled_course.show', $course) }}" class="block w-full text-center p-3 rounded-lg bg-blue-700 text-white font-bold hover:bg-blue-800 transition-colors">
                                    Lanjutkan Belajar
                                </a>
                            @else
                                <form action="{{ route('student.courses.enroll', $course) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full p-3 rounded-lg bg-blue-600 text-white font-bold hover:bg-blue-700 transition-colors">
                                        Daftar Sekarang
                                    </button>
                                </form>
                            @endif
                        @else
                            <a href="{{ route('student.login') }}?redirect={{ url()->current() }}" class="block w-full text-center p-3 rounded-lg bg-blue-600 text-white font-bold hover:bg-blue-700 transition-colors">
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