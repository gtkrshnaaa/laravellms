@extends('layouts.course_admin')
@section('title', 'Edit Video')

@section('content')
<div class="max-w-xl mx-auto">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-primary">Edit Video</h2>
        <p class="text-secondary text-sm">Mengubah video: <span class="font-medium text-primary">{{ $video->title }}</span></p>
    </div>

    <div class="p-6 bg-surface border border-border rounded-xl shadow-sm">
        <form action="{{ route('course_admin.management.topics.videos.update', [$topic, $video]) }}" method="POST">
            @csrf
            @method('PUT')
            @include('course_admin.dashboard.course_management.materials.videos._form')
        </form>
    </div>
</div>
@endsection