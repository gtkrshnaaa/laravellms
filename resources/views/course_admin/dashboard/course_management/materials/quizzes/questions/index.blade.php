@extends('layouts.course_admin')
@section('title', 'Manajemen Soal: ' . $quiz->title)

@section('content')
    <a href="{{ route('course_admin.management.topics.materials', $quiz->topic_id) }}" class="text-sm text-main-red hover:underline mb-4 inline-block transition duration-200">
        < Kembali ke Kelola Materi
    </a>
    <h1 class="text-2xl font-bold text-dark-text mb-4">Manajemen Soal untuk Kuis: "{{ $quiz->title }}"</h1>


    {{-- Form Tambah Soal Baru --}}
    <div class="bg-white p-6 rounded-lg border-2 border-gray-100 mb-4">
        <h2 class="text-xl font-semibold text-dark-text mb-4">Tambah Soal Baru</h2>
        <form action="{{ route('course_admin.management.quizzes.questions.store', $quiz) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="question_text" class="block text-dark-text font-medium mb-2">Teks Pertanyaan</label>
                <textarea name="question_text" id="question_text" rows="3" class="w-full border border-gray-300 px-3 py-2 rounded-md shadow-sm focus:border-main-red focus:ring-main-red" required>{{ old('question_text') }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-dark-text font-medium mb-2">Opsi Jawaban (Pilih jawaban yang benar)</label>
                @for ($i = 0; $i < 4; $i++)
                    <div class="flex items-center mb-2">
                        <input type="radio" name="correct_option" value="{{ $i }}" id="correct_option_{{ $i }}" class="h-4 w-4 text-main-red focus:ring-main-red border-gray-300" required>
                        <input type="text" name="options[]" placeholder="Opsi jawaban {{ $i + 1 }}" class="ml-3 flex-1 border border-gray-300 px-3 py-2 rounded-md shadow-sm focus:border-main-red focus:ring-main-red" required>
                    </div>
                @endfor
            </div>

            <div class="flex items-center">
                <button type="submit" class="bg-main-red hover:bg-dark-red text-white font-bold py-2 px-4 rounded-md transition duration-300">
                    Simpan Soal
                </button>
            </div>
        </form>
    </div>

    {{-- Daftar Soal yang Sudah Ada --}}
    <div class="bg-white p-6 rounded-lg border-2 border-gray-100 mb-8">
        <h2 class="text-xl font-semibold text-dark-text mb-4">Daftar Soal</h2>
        <div class="divide-y divide-gray-100">
            @forelse ($quiz->questions as $index => $question)
                <div class="py-4">
                    <div class="flex justify-between items-start mb-2">
                        <p class="font-bold text-dark-text">{{ $index + 1 }}. {{ $question->question_text }}</p>
                        <div class="space-x-2 whitespace-nowrap">
                            <a href="{{ route('course_admin.management.quizzes.questions.edit', [$quiz, $question]) }}" class="text-blue-600 hover:text-blue-800 font-semibold text-sm">Edit</a>
                            <form action="{{ route('course_admin.management.quizzes.questions.destroy', [$quiz, $question]) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus soal ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-600 hover:text-gray-800 font-semibold text-sm">Hapus</button>
                            </form>
                        </div>
                    </div>
                    <ul class="list-disc list-inside mt-2 pl-4 space-y-1">
                        @foreach ($question->options as $option)
                            <li class="{{ $option->is_correct ? 'text-green-600 font-bold' : 'text-light-text' }}">
                                {{ $option->option_text }}
                                @if ($option->is_correct)
                                    (Jawaban Benar)
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            @empty
                <p class="text-light-text text-center py-4">Belum ada soal untuk kuis ini.</p>
            @endforelse
        </div>
    </div>

@endsection