@extends('layouts.course_admin')
@section('title', 'Tambah Topik Baru')

@section('content')
<div class="max-w-xl mx-auto">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-primary">Tambah Topik</h2>
        <p class="text-secondary text-sm">Menambahkan topik baru ke kursus: <span class="font-medium text-primary">{{ $course->name }}</span></p>
    </div>

    <div class="p-6 bg-surface border border-border rounded-xl shadow-sm">
        <form action="{{ route('course_admin.management.courses.topics.store', $course) }}" method="POST">
            @csrf
            @include('course_admin.dashboard.course_management.topics._form')
        </form>
    </div>
</div>
@endsection