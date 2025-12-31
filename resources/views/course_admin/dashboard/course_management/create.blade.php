@extends('layouts.course_admin')
@section('title', 'Buat Kursus Baru')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-primary">Buat Kursus Baru</h2>
        <p class="text-secondary text-sm">Mulai perjalanan mengajar Anda dengan membuat kursus baru.</p>
    </div>

    <div class="p-6 bg-surface border border-border rounded-xl shadow-sm">
        <form action="{{ route('course_admin.management.courses.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('course_admin.dashboard.course_management._form')
        </form>
    </div>
</div>
@endsection