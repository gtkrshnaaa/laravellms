@extends('layouts.student')

@section('title', $course->name)

@section('content')
{{-- Hero Section --}}
<div class="relative bg-gradient-to-br from-primary to-gray-900 -m-8 mb-8 px-8 py-12 text-white shadow-lg overflow-hidden">
    <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 pointer-events-none"></div>
    <div class="relative z-10 max-w-4xl">
        <div class="flex items-center gap-2 mb-4 text-white/60 text-sm font-medium">
             @if($course->subCategory)
            <span class="bg-white/10 px-2.5 py-0.5 rounded-full border border-white/20">
                {{ $course->subCategory->category->name }}
            </span>
            <span>&bull;</span>
            <span>{{ $course->subCategory->name }}</span>
            @endif
        </div>
        <h1 class="text-3xl md:text-5xl font-bold tracking-tight mb-4 leading-tight">{{ $course->name }}</h1>
        <p class="text-lg md:text-xl text-white/80 leading-relaxed mb-6 max-w-2xl">{{ Str::limit($course->description, 150) }}</p>
        
        <div class="flex items-center gap-6">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center font-bold text-white border border-white/20">
                    {{ substr($course->courseAdmin->name, 0, 2) }}
                </div>
                <div>
                    <p class="text-xs text-white/50 uppercase tracking-widest font-bold">Instruktur</p>
                    <p class="font-semibold">{{ $course->courseAdmin->name }}</p>
                </div>
            </div>
             <div class="h-8 w-px bg-white/10"></div>
             <div>
                <p class="text-xs text-white/50 uppercase tracking-widest font-bold">Update Terakhir</p>
                <p class="font-semibold">{{ $course->updated_at->translatedFormat('d F Y') }}</p>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 px-1">
    
    {{-- Kolom Konten Utama (Kiri) --}}
    <div class="lg:col-span-2 space-y-8">
        {{-- Deskripsi --}}
        <div class="bg-surface p-8 border border-border rounded-2xl shadow-sm">
            <h2 class="text-2xl font-bold text-primary mb-4 flex items-center gap-2">
                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
                Deskripsi Lengkap
            </h2>
            <div class="prose dark:prose-invert max-w-none text-secondary">
                {{ $course->description }}
            </div>
        </div>

        {{-- Kurikulum --}}
        <div>
            <h2 class="text-2xl font-bold text-primary mb-6 flex items-center gap-2">
                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                Kurikulum Kursus
            </h2>
            <div class="space-y-4">
                @forelse($course->topics as $topic)
                    <div class="bg-surface border border-border rounded-xl overflow-hidden shadow-sm hover:border-primary/20 transition-all group" x-data="{ open: false }">
                        <button @click="open = !open" class="w-full text-left p-4 flex justify-between items-center bg-secondary/5 hover:bg-secondary/10 transition-colors">
                            <span class="font-bold text-primary flex items-center gap-3">
                                <span class="flex items-center justify-center w-6 h-6 rounded-full bg-primary/10 text-primary text-xs border border-primary/20">{{ $topic->order }}</span>
                                {{ $topic->title }}
                            </span>
                            <svg class="w-5 h-5 text-secondary transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="open" class="border-t border-border bg-background/50">
                            <ul class="divide-y divide-border/50">
                                @php
                                    $materials = $topic->videos
                                        ->concat($topic->quizzes)
                                        ->concat($topic->googleDriveMaterials)
                                        ->sortBy('order');
                                @endphp
                                @forelse ($materials as $material)
                                <li class="p-4 flex items-center text-sm text-secondary hover:bg-primary/5 transition-colors pl-12">
                                    @if($material instanceof \App\Models\Video)
                                        <svg class="w-4 h-4 text-red-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    @elseif($material instanceof \App\Models\Quiz)
                                         <svg class="w-4 h-4 text-purple-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    @else
                                        <svg class="w-4 h-4 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    @endif
                                    <span>{{ $material->title }}</span>
                                </li>
                                @empty
                                <li class="p-4 text-xs text-secondary/50 italic pl-12">Belum ada materi untuk topik ini.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8 bg-surface border border-border rounded-xl">
                         <p class="text-secondary">Kurikulum belum tersedia saat ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Kolom Sticky CTA (Kanan) --}}
    <div class="lg:col-span-1">
        <div class="sticky top-24">
            <div class="bg-surface rounded-2xl border border-border overflow-hidden shadow-lg">
                <div class="relative overflow-hidden aspect-video">
                    <img src="{{ $course->thumbnail ? Storage::url($course->thumbnail) : 'https://placehold.co/600x400/18181b/ffffff?text=Course' }}" alt="{{ $course->name }}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                </div>
                <div class="p-6">
                    @if($isEnrolled)
                        {{-- 1. Jika sudah terdaftar --}}
                         <div class="mb-6">
                            <span class="inline-block w-full text-center py-2 px-3 rounded-lg bg-green-500/10 border border-green-500/20 text-green-600 font-bold text-sm mb-2">
                                <i class="uil uil-check-circle mr-1"></i> Anda Sudah Terdaftar
                            </span>
                        </div>
                        <a href="{{ route('student.enrolled_course.show', $course) }}" class="flex justify-center items-center w-full py-3.5 px-6 rounded-xl bg-primary text-background font-bold tracking-wide hover:bg-primary/90 transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                            Lanjutkan Belajar
                        </a>
                    @else
                        {{-- 2. Jika belum terdaftar --}}
                        <div class="mb-6 flex items-baseline gap-2">
                             <span class="text-3xl font-bold text-primary">Gratis</span>
                             <span class="text-sm text-secondary line-through">Rp 0</span>
                        </div>
                        <form action="{{ route('student.courses.enroll', $course) }}" method="POST">
                            @csrf
                            <button type="submit" class="flex justify-center items-center w-full py-3.5 px-6 rounded-xl bg-primary text-background font-bold tracking-wide hover:bg-primary/90 transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                                Daftar Sekarang
                            </button>
                        </form>
                        <p class="text-xs text-center text-secondary/60 mt-4">Akses penuh seumur hidup.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>
@endsection