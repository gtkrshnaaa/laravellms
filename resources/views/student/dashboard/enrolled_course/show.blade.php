@extends('layouts.student')

@section('title', 'Belajar: ' . $course->name)

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-4 gap-8 lg:items-start">
    {{-- Main Content Area --}}
    <div class="lg:col-span-3 bg-white rounded-lg border border-blue-100 p-6">
        @if($current_material)
            {{-- Tampilkan Judul & Deskripsi dari Materi --}}
            <h1 class="text-3xl font-bold text-black">{{ $current_material->title }}</h1>
            <p class="text-gray-600 mt-1 mb-6">{{ $current_material->description ?? 'Materi dari topik: ' . $current_material->topic->title }}</p>

            {{-- Tampilkan Info Skor Terakhir (JIKA ADA) --}}
            @if(isset($lastAttempt))
            <div class="p-4 mb-4 text-sm rounded-lg {{ $lastAttempt->passed ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}" role="alert">
                <span class="font-medium">Percobaan Terakhir Anda:</span> Skor {{ round($lastAttempt->score) }}. {{ $lastAttempt->passed ? 'Anda sudah lulus kuis ini.' : 'Anda belum lulus, silakan coba lagi.' }}
            </div>
            @endif

            {{-- === KONTEN DINAMIS: VIDEO, KUIS, ATAU GOOGLE DRIVE === --}}
            @if($current_material instanceof \App\Models\Video)
                {{-- Bagian untuk menampilkan Video --}}
                <div class="aspect-w-16 aspect-h-9 relative" style="padding-top: 56.25%;">
                    <iframe src="{{ $current_material->youtube_url }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="absolute top-0 left-0 w-full h-full rounded-lg shadow-inner"></iframe>
                </div>

                {{-- Tombol navigasi setelah Video --}}
                <div class="mt-8 pt-6 border-t border-blue-100 flex justify-between items-center">
                    {{-- Tombol Sebelumnya --}}
                    @if($previous_material)
                        @php
                            $prev_route = '#';
                            if ($previous_material instanceof \App\Models\Video) $prev_route = route('student.enrolled_course.video', [$course, $previous_material]);
                            elseif ($previous_material instanceof \App\Models\Quiz) $prev_route = route('student.enrolled_course.quiz', [$course, $previous_material]);
                            elseif ($previous_material instanceof \App\Models\GoogleDriveMaterial) $prev_route = route('student.enrolled_course.googledrive', [$course, $previous_material]);
                        @endphp
                        <a href="{{ $prev_route }}" class="px-4 py-2 rounded-lg bg-blue-50 text-black font-bold hover:bg-blue-100 transition-colors">
                            <i class="uil uil-arrow-left"></i> Sebelumnya
                        </a>
                    @else
                        <span></span> {{-- Placeholder agar 'justify-between' berfungsi --}}
                    @endif

                    {{-- Form Tandai Selesai --}}
                    <form action="{{ route('student.enrolled_course.progress', ['course' => $course, 'completable_type' => 'video', 'completable_id' => $current_material->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="px-6 py-3 rounded-lg bg-blue-600 text-white font-bold hover:bg-blue-700 transition-colors">
                            Tandai Selesai & Lanjut <i class="uil uil-arrow-right"></i>
                        </button>
                    </form>
                </div>

            @elseif($current_material instanceof \App\Models\Quiz)
                {{-- Bagian untuk menampilkan Kuis --}}
                <form action="{{ route('student.enrolled_course.quiz.submit', ['course' => $course, 'quiz' => $current_material]) }}" method="POST">
                    @csrf
                    <div class="space-y-8">
                        @forelse($current_material->questions as $question_index => $question)
                            <div class="border-t border-blue-100 pt-6">
                                <p class="text-lg font-semibold text-black">{{ $question_index + 1 }}. {{ $question->question_text }}</p>
                                <div class="mt-4 space-y-3">
                                    @foreach($question->options as $option)
                                    <label class="flex items-center p-3 border border-blue-100 rounded-lg hover:bg-blue-50 hover:border-blue-200 transition-colors cursor-pointer">
                                        <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option->id }}" class="h-5 w-5 text-blue-600 focus:ring-blue-500">
                                        <span class="ml-4 text-black">{{ $option->option_text }}</span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        @empty
                             <p class="text-gray-500">Soal untuk kuis ini belum tersedia.</p>
                        @endforelse
                    </div>
                    @if($current_material->questions->isNotEmpty())
                        <div class="mt-8 pt-6 border-t border-blue-100 flex justify-between items-center">
                            {{-- Tombol Sebelumnya --}}
                            @if($previous_material)
                                @php
                                    $prev_route = '#';
                                    if ($previous_material instanceof \App\Models\Video) $prev_route = route('student.enrolled_course.video', [$course, $previous_material]);
                                    elseif ($previous_material instanceof \App\Models\Quiz) $prev_route = route('student.enrolled_course.quiz', [$course, $previous_material]);
                                    elseif ($previous_material instanceof \App\Models\GoogleDriveMaterial) $prev_route = route('student.enrolled_course.googledrive', [$course, $previous_material]);
                                @endphp
                                <a href="{{ $prev_route }}" class="px-4 py-2 rounded-lg bg-blue-50 text-black font-bold hover:bg-blue-100 transition-colors">
                                    <i class="uil uil-arrow-left"></i> Sebelumnya
                                </a>
                            @else
                                <span></span>
                            @endif

                            <button type="submit" class="px-8 py-3 rounded-lg bg-blue-700 text-white font-bold hover:bg-blue-800 transition-colors">
                                Kumpulkan Jawaban
                            </button>
                        </div>
                    @endif
                </form>

            @elseif($current_material instanceof \App\Models\GoogleDriveMaterial)
                {{-- Bagian untuk menampilkan Materi Google Drive --}}
                <div class="prose max-w-none p-4 border border-blue-100 rounded-lg mb-6">
                    <p>{!! nl2br(e($current_material->description)) !!}</p>
                </div>
                
                <a href="{{ $current_material->google_drive_url }}" target="_blank" class="inline-flex items-center px-6 py-3 rounded-lg bg-blue-600 text-white font-bold hover:bg-blue-700 transition-colors">
                    <i class="uil uil-google-drive-alt mr-2"></i> Buka Materi di Google Drive
                </a>

                {{-- Tombol navigasi --}}
                <div class="mt-8 pt-6 border-t-2 border-gray-100 flex justify-between items-center">
                    {{-- Tombol Sebelumnya --}}
                    @if($previous_material)
                        @php
                            $prev_route = '#';
                            if ($previous_material instanceof \App\Models\Video) $prev_route = route('student.enrolled_course.video', [$course, $previous_material]);
                            elseif ($previous_material instanceof \App\Models\Quiz) $prev_route = route('student.enrolled_course.quiz', [$course, $previous_material]);
                            elseif ($previous_material instanceof \App\Models\GoogleDriveMaterial) $prev_route = route('student.enrolled_course.googledrive', [$course, $previous_material]);
                        @endphp
                        <a href="{{ $prev_route }}" class="px-4 py-2 rounded-lg bg-blue-50 text-black font-bold hover:bg-blue-100">
                            <i class="uil uil-arrow-left"></i> Sebelumnya
                        </a>
                    @else
                        <span></span>
                    @endif

                    {{-- Form Tandai Selesai --}}
                    <form action="{{ route('student.enrolled_course.progress', ['course' => $course, 'completable_type' => 'googledrive', 'completable_id' => $current_material->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="px-6 py-3 rounded-lg bg-blue-600 text-white font-bold hover:bg-blue-700">
                            Tandai Selesai & Lanjut <i class="uil uil-arrow-right"></i>
                        </button>
                    </form>
                </div>
            @endif

            @if(session('error'))
                <div class="p-4 mt-4 text-sm text-black rounded-lg bg-blue-50" role="alert">
                    <span class="font-medium">Gagal!</span> {{ session('error') }}
                </div>
            @endif
        @else
            <h1 class="text-3xl font-bold text-black">Kursus ini belum memiliki materi.</h1>
            <p class="text-gray-600 mt-2">Silakan kembali lagi nanti.</p>
        @endif
    </div>

    {{-- Sidebar Daftar Materi --}}
    <div class="lg:col-span-1 bg-white rounded-lg border border-blue-100 p-6 h-fit sticky top-24">
        <h2 class="text-xl font-bold text-black mb-4">{{ $course->name }}</h2>
        <div class="h-[60vh] overflow-y-auto pr-2">
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
                
                <h3 class="font-bold text-black mt-4 mb-2 px-3">{{ $topic->order }}. {{ $topic->title }}</h3>
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
                               class="flex items-center p-3 rounded-lg text-left w-full transition-colors {{ $isLocked ? 'opacity-50 cursor-not-allowed bg-white' : ($is_active ? 'bg-blue-50 text-black font-bold' : 'text-black hover:bg-blue-50') }}">
                                
                                @if ($is_completed)
                                    <i class="uil uil-check-circle text-xl text-green-500"></i>
                                @elseif ($isLocked)
                                    <i class="uil uil-lock text-xl text-gray-400"></i>
                                @else
                                    @if($material instanceof \App\Models\Video) <i class="uil uil-play-circle text-xl {{ $is_active ? 'text-blue-600' : 'text-gray-400' }}"></i> @endif
                                    @if($material instanceof \App\Models\Quiz) <i class="uil uil-file-question-alt text-xl {{ $is_active ? 'text-blue-600' : 'text-gray-400' }}"></i> @endif
                                    @if($material instanceof \App\Models\GoogleDriveMaterial) <i class="uil uil-google-drive-alt text-xl {{ $is_active ? 'text-blue-600' : 'text-gray-400' }}"></i> @endif
                                @endif
                                
                                <span class="ml-3 flex-1 text-sm">{{ $material->title }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>

                @if (!$loop->last)
                <div class="flex items-center my-3">
                    <div class="flex-grow border-t border-blue-100"></div>
                    <span class="mx-2 text-gray-400"><i class="uil uil-ellipsis-h"></i></span>
                    <div class="flex-grow border-t border-blue-100"></div>
                </div>
                @endif

                @php
                    $previousTopic = $topic;
                @endphp
            @endforeach

            @if($course->followUpLinks->isNotEmpty())
                <div class="mt-6 pt-4 border-t border-blue-100">
                    <h3 class="font-bold text-black mb-2 px-3">Tautan Penting</h3>
                    <ul class="space-y-1">
                        @foreach ($course->followUpLinks as $link)
                            <li>
                                <a href="{{ $link->url }}" target="_blank" class="flex items-center p-3 rounded-lg text-left w-full text-sm text-black hover:bg-blue-50">
                                    <i class="uil uil-external-link-alt text-xl text-blue-500"></i>
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