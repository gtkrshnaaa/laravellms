@extends('layouts.course_admin')
@section('title', 'Tambah Video')

@section('content')
<div class="max-w-xl mx-auto">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-primary">Tambah Video</h2>
        <p class="text-secondary text-sm">Topik: <span class="font-medium text-primary">{{ $topic->title }}</span></p>
    </div>

    <div class="p-6 bg-surface border border-border rounded-xl shadow-sm">
        <form action="{{ route('course_admin.management.topics.videos.store', $topic) }}" method="POST">
            @csrf
            @include('course_admin.dashboard.course_management.materials.videos._form')
        </form>
    </div>
</div>
@endsection