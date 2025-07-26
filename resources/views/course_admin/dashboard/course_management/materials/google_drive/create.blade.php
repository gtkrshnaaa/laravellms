@extends('layouts.course_admin')
@section('title', 'Tambah Materi Google Drive')

@section('content')
    <a href="{{ route('course_admin.management.topics.materials', $topic) }}" class="text-sm text-main-red hover:underline mb-4 inline-block">
        < Kembali ke Kelola Materi
    </a>
    <h1 class="text-2xl font-bold text-dark-text mb-4">Tambah Materi Drive: {{ $topic->title }}</h1>
    <div class="bg-white p-6 rounded-lg border-2 border-gray-100">
        <form action="{{ route('course_admin.management.topics.googledrive.store', $topic) }}" method="POST">
            @include('course_admin.dashboard.course_management.materials.google_drive._form')
        </form>
    </div>
@endsection