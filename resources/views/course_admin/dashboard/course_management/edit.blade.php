@extends('layouts.course_admin')
@section('title', 'Edit Kursus')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-primary">Edit Kursus</h2>
        <p class="text-secondary text-sm">Perbarui informasi kursus: <span class="font-mono text-primary">{{ $course->name }}</span></p>
    </div>

    <div class="p-6 bg-surface border border-border rounded-xl shadow-sm">
        <form action="{{ route('course_admin.management.courses.update', $course) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('course_admin.dashboard.course_management._form')
        </form>
    </div>
</div>
@endsection