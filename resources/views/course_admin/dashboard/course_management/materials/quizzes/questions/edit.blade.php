{{-- FILE: resources/views/course_admin/dashboard/course_management/materials/quizzes/questions/edit.blade.php --}}
@extends('layouts.course_admin')
@section('title', 'Edit Soal: ' . Str::limit($question->question_text, 30))

@section('content')
    <a href="{{ route('course_admin.management.quizzes.questions.index', $quiz) }}" class="text-sm text-main-red hover:underline mb-4 inline-block transition duration-200">
        < Kembali ke Manajemen Soal
    </a>
    <h1 class="text-2xl font-bold text-dark-text mb-4">Edit Soal Kuis</h1>
    
    <div class="bg-white p-6 rounded-lg border-2 border-gray-100">
        <form action="{{ route('course_admin.management.quizzes.questions.update', [$quiz, $question]) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label for="question_text" class="block text-dark-text font-medium mb-2">Teks Pertanyaan</label>
                <textarea name="question_text" id="question_text" rows="3" class="w-full border border-gray-300 px-3 py-2 rounded-md shadow-sm focus:border-main-red focus:ring-main-red" required>{{ old('question_text', $question->question_text) }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-dark-text font-medium mb-2">Opsi Jawaban (Pilih jawaban yang benar)</label>
                @foreach($question->options as $index => $option)
                    <div class="flex items-center mb-2">
                        <input type="radio" name="correct_option" value="{{ $index }}" id="correct_option_{{ $index }}" class="h-4 w-4 text-main-red focus:ring-main-red border-gray-300" 
                               {{-- Logic untuk pre-check radio button yang benar --}}
                               {{ old('correct_option', $option->is_correct ? $index : -1) == $index ? 'checked' : '' }} required>
                        <input type="text" name="options[]" placeholder="Opsi jawaban {{ $index + 1 }}" value="{{ old('options.'.$index, $option->option_text) }}" class="ml-3 flex-1 border border-gray-300 px-3 py-2 rounded-md shadow-sm focus:border-main-red focus:ring-main-red" required>
                    </div>
                @endforeach
            </div>

            <div class="flex items-center">
                <button type="submit" class="bg-main-red hover:bg-dark-red text-white font-bold py-2 px-4 rounded-md transition duration-300">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
@endsection