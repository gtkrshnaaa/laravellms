@extends('layouts.course_admin')
@section('title', 'Edit Materi Google Drive')

@section('content')
<div class="max-w-xl mx-auto">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-primary">Edit Materi Google Drive</h2>
        <p class="text-secondary text-sm">Update informasi materi.</p>
    </div>

    <div class="p-6 bg-surface border border-border rounded-xl shadow-sm">
        <form action="{{ route('course_admin.management.topics.googledrive.update', [$topic, $googleDriveMaterial]) }}" method="POST">
            @method('PUT')
            @include('course_admin.dashboard.course_management.materials.google_drive._form', ['googleDriveMaterial' => $googleDriveMaterial])
        </form>
    </div>
</div>
@endsection