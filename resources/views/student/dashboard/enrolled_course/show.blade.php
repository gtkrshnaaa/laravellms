@extends('layouts.student')

@section('title', 'Belajar: ' . $course->name)

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-4 gap-6 lg:items-start h-[calc(100vh-100px)]">
    {{-- Main Content Area --}}
    <div class="lg:col-span-3 h-full flex flex-col">
        <div class="bg-surface rounded-2xl border border-border p-6 flex-1 flex flex-col overflow-y-auto">
            @if($current_material)
                {{-- Tampilkan Judul & Deskripsi dari Materi --}}
                <div class="mb-6">
                     <h1 class="text-2xl md:text-3xl font-bold text-primary tracking-tight">{{ $current_material->title }}</h1>
                    <p class="text-secondary mt-2">{{ $current_material->description ?? 'Materi dari topik: ' . $current_material->topic->title }}</p>
                </div>

                {{-- Tampilkan Info Skor Terakhir (JIKA ADA) --}}
                @if(isset($lastAttempt))
                <div class="p-4 mb-6 text-sm rounded-xl border {{ $lastAttempt->passed ? 'bg-green-500/10 border-green-500/20 text-green-600' : 'bg-yellow-500/10 border-yellow-500/20 text-yellow-600' }}" role="alert">
                    <span class="font-bold flex items-center gap-2">
                        @if($lastAttempt->passed)
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        @else
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        @endif
                        Percobaan Terakhir Anda:
                    </span> 
                    Skor {{ round($lastAttempt->score) }}. {{ $lastAttempt->passed ? 'Anda sudah lulus kuis ini.' : 'Anda belum lulus, silakan coba lagi.' }}
                </div>
                @endif

                {{-- === KONTEN DINAMIS: VIDEO, KUIS, ATAU GOOGLE DRIVE === --}}
                <div class="flex-1 min-h-[400px]">
                    @if($current_material instanceof \App\Models\Video)
                        {{-- Bagian untuk menampilkan Video --}}
                        <div class="aspect-video relative rounded-xl overflow-hidden shadow-lg border border-border bg-black">
                            <iframe src="{{ $current_material->youtube_url }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="absolute top-0 left-0 w-full h-full"></iframe>
                        </div>

                        {{-- Tombol navigasi setelah Video --}}
                        <div class="mt-8 pt-6 border-t border-border flex justify-between items-center">
                            {{-- Tombol Sebelumnya --}}
                            @if($previous_material)
                                @php
                                    $prev_route = '#';
                                    if ($previous_material instanceof \App\Models\Video) $prev_route = route('student.enrolled_course.video', [$course, $previous_material]);
                                    elseif ($previous_material instanceof \App\Models\Quiz) $prev_route = route('student.enrolled_course.quiz', [$course, $previous_material]);
                                    elseif ($previous_material instanceof \App\Models\GoogleDriveMaterial) $prev_route = route('student.enrolled_course.googledrive', [$course, $previous_material]);
                                @endphp
                                <a href="{{ $prev_route }}" class="px-5 py-2.5 rounded-xl bg-surface border border-border text-secondary font-medium hover:bg-gray-50 dark:hover:bg-white/5 hover:text-primary hover:border-primary transition-all">
                                    <i class="uil uil-arrow-left mr-1"></i> Sebelumnya
                                </a>
                            @else
                                <span></span> 
                            @endif

                            {{-- Form Tandai Selesai --}}
                            <form action="{{ route('student.enrolled_course.progress', ['course' => $course, 'completable_type' => 'video', 'completable_id' => $current_material->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-6 py-2.5 rounded-xl bg-primary text-background font-bold hover:bg-primary/90 transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                                    Tandai Selesai & Lanjut <i class="uil uil-arrow-right ml-1"></i>
                                </button>
                            </form>
                        </div>

                    @elseif($current_material instanceof \App\Models\Quiz)
                        {{-- Bagian untuk menampilkan Kuis --}}
                        <form action="{{ route('student.enrolled_course.quiz.submit', ['course' => $course, 'quiz' => $current_material]) }}" method="POST">
                            @csrf
                            <div class="space-y-8">
                                @forelse($current_material->questions as $question_index => $question)
                                    <div class="border border-border rounded-xl p-6 bg-surface/50">
                                        <p class="text-lg font-bold text-primary mb-4">{{ $question_index + 1 }}. {{ $question->question_text }}</p>
                                        <div class="space-y-3">
                                            @foreach($question->options as $option)
                                            <label class="flex items-center p-4 border border-border rounded-xl hover:bg-primary/5 hover:border-primary/30 transition-all cursor-pointer group">
                                                <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option->id }}" class="h-5 w-5 text-primary border-secondary focus:ring-primary bg-transparent">
                                                <span class="ml-4 text-secondary group-hover:text-primary transition-colors">{{ $option->option_text }}</span>
                                            </label>
                                            @endforeach
                                        </div>
                                    </div>
                                @empty
                                     <div class="text-center py-10 text-secondary italic border border-border border-dashed rounded-xl">Soal untuk kuis ini belum tersedia.</div>
                                @endforelse
                            </div>
                            @if($current_material->questions->isNotEmpty())
                                <div class="mt-8 pt-6 border-t border-border flex justify-between items-center">
                                    {{-- Tombol Sebelumnya --}}
                                    @if($previous_material)
                                        @php
                                            $prev_route = '#';
                                            if ($previous_material instanceof \App\Models\Video) $prev_route = route('student.enrolled_course.video', [$course, $previous_material]);
                                            elseif ($previous_material instanceof \App\Models\Quiz) $prev_route = route('student.enrolled_course.quiz', [$course, $previous_material]);
                                            elseif ($previous_material instanceof \App\Models\GoogleDriveMaterial) $prev_route = route('student.enrolled_course.googledrive', [$course, $previous_material]);
                                        @endphp
                                        <a href="{{ $prev_route }}" class="px-5 py-2.5 rounded-xl bg-surface border border-border text-secondary font-medium hover:text-primary hover:border-primary transition-all flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg> Sebelumnya
                                        </a>
                                    @else
                                        <span></span>
                                    @endif

                                    <button type="submit" class="px-8 py-2.5 rounded-xl bg-primary text-background font-bold hover:bg-primary/90 transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                                        Kumpulkan Jawaban
                                    </button>
                                </div>
                            @endif
                        </form>

                    @elseif($current_material instanceof \App\Models\GoogleDriveMaterial)
                        {{-- Bagian untuk menampilkan Materi Google Drive --}}
                        <div class="prose dark:prose-invert max-w-none p-6 border border-border rounded-xl mb-6 bg-surface/50">
                            <p>{!! nl2br(e($current_material->description)) !!}</p>
                        </div>
                        
                        <a href="{{ $current_material->google_drive_url }}" target="_blank" class="inline-flex items-center px-6 py-4 rounded-xl bg-surface border border-border text-primary font-bold hover:bg-primary/5 hover:border-primary transition-all group w-full justify-center">
                            <svg class="w-6 h-6 mr-3 text-secondary group-hover:text-primary transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg> 
                            <span>Buka Materi di Google Drive</span>
                            <svg class="w-4 h-4 ml-2 text-secondary group-hover:text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                        </a>

                        {{-- Tombol navigasi --}}
                        <div class="mt-8 pt-6 border-t border-border flex justify-between items-center">
                            {{-- Tombol Sebelumnya --}}
                            @if($previous_material)
                                @php
                                    $prev_route = '#';
                                    if ($previous_material instanceof \App\Models\Video) $prev_route = route('student.enrolled_course.video', [$course, $previous_material]);
                                    elseif ($previous_material instanceof \App\Models\Quiz) $prev_route = route('student.enrolled_course.quiz', [$course, $previous_material]);
                                    elseif ($previous_material instanceof \App\Models\GoogleDriveMaterial) $prev_route = route('student.enrolled_course.googledrive', [$course, $previous_material]);
                                @endphp
                                <a href="{{ $prev_route }}" class="px-5 py-2.5 rounded-xl bg-surface border border-border text-secondary font-medium hover:bg-gray-50 dark:hover:bg-white/5 hover:text-primary hover:border-primary transition-all">
                                    <i class="uil uil-arrow-left mr-1"></i> Sebelumnya
                                </a>
                            @else
                                <span></span>
                            @endif

                            {{-- Form Tandai Selesai --}}
                            <form action="{{ route('student.enrolled_course.progress', ['course' => $course, 'completable_type' => 'googledrive', 'completable_id' => $current_material->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-6 py-2.5 rounded-xl bg-primary text-background font-bold hover:bg-primary/90 transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                                    Tandai Selesai & Lanjut <i class="uil uil-arrow-right ml-1"></i>
                                </button>
                            </form>
                        </div>
                    @endif
                </div>

                @if(session('error'))
                    <div class="p-4 mt-6 text-sm text-red-500 rounded-xl bg-red-500/10 border border-red-500/20" role="alert">
                        <span class="font-bold">Gagal!</span> {{ session('error') }}
                    </div>
                @endif
            @else
                <div class="flex flex-col items-center justify-center h-full text-center p-12">
                     <div class="w-16 h-16 rounded-full bg-secondary/10 flex items-center justify-center text-secondary mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <h1 class="text-2xl font-bold text-primary">Kursus ini belum memiliki materi.</h1>
                    <p class="text-secondary mt-2">Silakan kembali lagi nanti saat instruktur sudah menambahkan konten.</p>
                </div>
            @endif
        </div>
    </div>

    {{-- Sidebar Daftar Materi --}}
    <div class="lg:col-span-1 bg-surface rounded-2xl border border-border p-0 h-full flex flex-col overflow-hidden sticky top-24">
        <div class="p-5 border-b border-border bg-surface/50 backdrop-blur-sm z-10">
             <h2 class="text-lg font-bold text-primary line-clamp-1" title="{{ $course->name }}">{{ $course->name }}</h2>
             <div class="w-full bg-border mt-3 rounded-full h-1.5 overflow-hidden">
                <div class="bg-green-500 h-1.5 rounded-full" style="width: {{ $course->current_progress ?? 0 }}%"></div>
             </div>
             <p class="text-[10px] text-secondary mt-1 text-right">{{ $course->current_progress ?? 0 }}% Selesai</p>
        </div>
        
        <div class="flex-1 overflow-y-auto custom-scrollbar p-2">
            @php
                $previousTopic = null;
                $isLocked = false;
            @endphp
            @foreach($course->topics as $topic)
                @if($previousTopic && !$isLocked)
                    @php
                        if (!auth('student')->user()->isTopicCompleted($previousTopic)) {
                            $isLocked = true;
                        }
                    @endphp
                @endif
                
                <h3 class="font-bold text-xs uppercase tracking-wider text-secondary mt-4 mb-2 px-3">{{ $topic->order }}. {{ $topic->title }}</h3>
                <ul class="space-y-1">
                    @php
                        $topicMaterials = $topic->videos
                            ->concat($topic->quizzes)
                            ->concat($topic->googleDriveMaterials)
                            ->sortBy('order');
                    @endphp
                    @foreach($topicMaterials as $material)
                        @php
                            $route = '#';
                            if ($material instanceof \App\Models\Video) $route = route('student.enrolled_course.video', [$course, $material]);
                            elseif ($material instanceof \App\Models\Quiz) $route = route('student.enrolled_course.quiz', [$course, $material]);
                            elseif ($material instanceof \App\Models\GoogleDriveMaterial) $route = route('student.enrolled_course.googledrive', [$course, $material]);

                            $is_active = $current_material && $current_material->id == $material->id && get_class($current_material) == get_class($material);
                            $is_completed = isset($completedMaterials[get_class($material) . '-' . $material->id]);
                        @endphp
                        <li>
                            <a href="{{ $isLocked ? '#' : $route }}"
                               class="flex items-center p-3 rounded-xl text-left w-full transition-all border border-transparent {{ $isLocked ? 'opacity-50 cursor-not-allowed text-secondary bg-gray-50 dark:bg-white/5' : ($is_active ? 'bg-primary/5 text-primary font-bold border-primary/10 shadow-sm' : 'text-secondary hover:bg-gray-50 dark:hover:bg-white/5 hover:text-primary hover:border-border') }}">
                                
                                @if ($is_completed)
                                    <svg class="w-5 h-5 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                @elseif ($isLocked)
                                    <svg class="w-5 h-5 text-secondary/50 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                @else
                                    @if($material instanceof \App\Models\Video) <svg class="w-5 h-5 {{ $is_active ? 'text-primary' : 'text-secondary' }} shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> @endif
                                    @if($material instanceof \App\Models\Quiz) <svg class="w-5 h-5 {{ $is_active ? 'text-primary' : 'text-secondary' }} shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg> @endif
                                    @if($material instanceof \App\Models\GoogleDriveMaterial) <svg class="w-5 h-5 {{ $is_active ? 'text-primary' : 'text-secondary' }} shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg> @endif
                                @endif
                                
                                <span class="ml-3 flex-1 text-xs md:text-sm line-clamp-1">{{ $material->title }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>

                @if (!$loop->last)
                <div class="flex items-center my-3 px-3">
                    <div class="flex-grow border-t border-border"></div>
                </div>
                @endif

                @php
                    $previousTopic = $topic;
                @endphp
            @endforeach

            @if($course->followUpLinks->isNotEmpty())
                <div class="mt-6 pt-4 border-t border-border">
                    <h3 class="font-bold text-xs uppercase tracking-wider text-secondary mb-2 px-3">Tautan Penting</h3>
                    <ul class="space-y-1">
                        @foreach ($course->followUpLinks as $link)
                            <li>
                                <a href="{{ $link->url }}" target="_blank" class="flex items-center p-3 rounded-xl text-left w-full text-sm text-secondary hover:bg-gray-50 dark:hover:bg-white/5 hover:text-primary border border-transparent hover:border-border transition-all">
                                    <svg class="w-4 h-4 text-blue-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                    <span class="ml-3 flex-1">{{ $link->label }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </div>
    </div>
</div>
@endsection