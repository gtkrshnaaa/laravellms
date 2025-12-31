@extends('layouts.course_admin')
@section('title', 'Edit Kuis')

@section('content')
<div class="max-w-xl mx-auto">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-primary">Edit Kuis</h2>
        <p class="text-secondary text-sm">Mengubah kuis: <span class="font-medium text-primary">{{ $quiz->title }}</span></p>
    </div>

    <div class="p-6 bg-surface border border-border rounded-xl shadow-sm">
        <form action="{{ route('course_admin.management.topics.quizzes.update', [$topic, $quiz]) }}" method="POST">
            @csrf
            @method('PUT')
            @include('course_admin.dashboard.course_management.materials.quizzes._form')
        </form>
    </div>
</div>
@endsection