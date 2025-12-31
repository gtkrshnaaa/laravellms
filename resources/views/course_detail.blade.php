@extends('layouts.app') {{-- Use Public App Layout for consistency --}}
@section('title', $course->name)

@section('content')
{{-- Hero Section --}}
<div class="bg-surface border-b border-border py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row gap-8 items-start">
            <div class="flex-1">
                <div class="flex items-center gap-2 mb-4">
                     @if($course->subCategory)
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary/10 text-primary">
                        {{ $course->subCategory->category->name }}
                    </span>
                    <span class="text-secondary/50 text-xs">/</span>
                    <span class="text-secondary text-sm font-medium">{{ $course->subCategory->name }}</span>
                    @endif
                </div>
                <h1 class="text-3xl md:text-4xl font-bold text-primary mb-4 leading-tight">{{ $course->name }}</h1>
                <p class="text-lg text-secondary leading-relaxed mb-6">{{ $course->description }}</p>
                <div class="flex items-center gap-4 text-sm text-secondary">
                    <div class="flex items-center gap-1.5">
                        <svg class="w-5 h-5 text-secondary/70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        <span>Dibuat oleh <span class="font-semibold text-primary">{{ $course->courseAdmin->name }}</span></span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <svg class="w-5 h-5 text-secondary/70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>Update terakhir {{ $course->updated_at->format('d M Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12">
        
        {{-- Main Content (Left) --}}
        <div class="lg:col-span-2 space-y-10">
            
            {{-- What you'll learn --}}
            <div class="bg-surface border border-border rounded-2xl p-6 md:p-8 shadow-sm">
                <h2 class="text-xl font-bold text-primary mb-6 flex items-center gap-2">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Apa yang akan Anda pelajari
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex gap-3">
                        <svg class="w-5 h-5 text-green-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span class="text-secondary text-sm">Materi video berkualitas tinggi untuk pemahaman mendalam.</span>
                    </div>
                    <div class="flex gap-3">
                        <svg class="w-5 h-5 text-green-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span class="text-secondary text-sm">Kuis interaktif untuk mengasah kemampuan Anda.</span>
                    </div>
                    <div class="flex gap-3">
                        <svg class="w-5 h-5 text-green-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span class="text-secondary text-sm">Akses materi selamanya tanpa batas waktu.</span>
                    </div>
                     <div class="flex gap-3">
                        <svg class="w-5 h-5 text-green-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span class="text-secondary text-sm">Belajar fleksibel di mana saja dan kapan saja.</span>
                    </div>
                </div>
            </div>

            {{-- Curriculum --}}
            <div>
                <h2 class="text-2xl font-bold text-primary mb-6">Konten Kursus</h2>
                <div class="space-y-4">
                    @forelse($course->topics as $topic)
                        <div class="bg-surface border border-border rounded-2xl overflow-hidden shadow-sm" x-data="{ open: false }">
                            <button @click="open = !open" class="w-full text-left p-4 md:p-5 flex justify-between items-center bg-secondary/5 hover:bg-secondary/10 transition-colors">
                                <span class="font-bold text-primary flex items-center gap-3">
                                    <svg class="w-5 h-5 text-secondary" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    {{ $topic->order }}. {{ $topic->title }}
                                </span>
                                <span class="text-xs text-secondary font-medium">
                                    {{ $topic->videos->count() + $topic->quizzes->count() + $topic->googleDriveMaterials->count() }} Materi
                                </span>
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
                                    <li class="p-4 flex items-center gap-3 text-sm text-secondary hover:bg-primary/5 transition-colors pl-8 md:pl-12">
                                        @if($material instanceof \App\Models\Video)
                                            <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        @elseif($material instanceof \App\Models\Quiz)
                                             <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                        @else
                                            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                        @endif
                                        <span>{{ $material->title }}</span>
                                    </li>
                                    @empty
                                    <li class="p-4 text-xs text-secondary/50 italic pl-12">Belum ada materi.</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8 bg-surface border border-border rounded-xl">
                            <p class="text-secondary">Kurikulum sedang disusun.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Sidebar (Right) --}}
        <div class="lg:col-span-1">
            <div class="sticky top-24 space-y-6">
                {{-- Course Card --}}
                <div class="bg-surface border border-border rounded-2xl overflow-hidden shadow-lg p-1">
                    <div class="rounded-xl overflow-hidden relative aspect-video group">
                         @if($course->thumbnail)
                            <img src="{{ Storage::url($course->thumbnail) }}" alt="{{ $course->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full bg-secondary/10 flex items-center justify-center text-secondary/30">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </div>
                    <div class="p-5">
                         <div class="flex items-center justify-between mb-6">
                            <span class="text-3xl font-bold text-primary">Gratis</span>
                            <span class="text-xs font-semibold text-green-700 bg-green-100 border border-green-200 px-2.5 py-1 rounded-full">Kursus Terbuka</span>
                        </div>

                        {{-- CTA Button --}}
                        @auth('student')
                            @if($isEnrolled)
                                <a href="{{ route('student.enrolled_course.show', $course) }}" class="w-full flex justify-center items-center py-3.5 px-6 rounded-xl bg-primary text-white font-bold text-sm tracking-wide shadow-lg shadow-primary/25 hover:bg-primary/90 hover:shadow-xl hover:shadow-primary/30 transform hover:-translate-y-0.5 transition-all duration-200">
                                    Lanjut Belajar
                                </a>
                            @else
                                <form action="{{ route('student.courses.enroll', $course) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full flex justify-center items-center py-3.5 px-6 rounded-xl bg-primary text-white font-bold text-sm tracking-wide shadow-lg shadow-primary/25 hover:bg-primary/90 hover:shadow-xl hover:shadow-primary/30 transform hover:-translate-y-0.5 transition-all duration-200">
                                        Daftar Sekarang
                                    </button>
                                </form>
                            @endif
                        @else
                            <a href="{{ route('student.login') }}?redirect={{ url()->current() }}" class="w-full flex justify-center items-center py-3.5 px-6 rounded-xl bg-secondary text-white font-bold text-sm tracking-wide shadow-lg hover:bg-secondary/90 transform hover:-translate-y-0.5 transition-all duration-200">
                                Login untuk Daftar
                            </a>
                        @endguest

                        <p class="text-xs text-center text-secondary/60 mt-4">Akses penuh seumur hidup.</p>
                    </div>
                </div>

                {{-- Instructor Card (Mini) --}}
                <div class="bg-surface border border-border rounded-2xl p-5 shadow-sm">
                    <h3 class="font-bold text-primary mb-4 text-sm uppercase tracking-wider">Instruktur</h3>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold">
                            {{ substr($course->courseAdmin->name, 0, 2) }}
                        </div>
                        <div>
                            <div class="font-bold text-primary">{{ $course->courseAdmin->name }}</div>
                            <div class="text-xs text-secondary">Course Creator</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection