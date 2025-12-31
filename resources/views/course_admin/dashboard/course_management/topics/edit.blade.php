@extends('layouts.course_admin')
@section('title', 'Edit Topik')

@section('content')
<div class="max-w-xl mx-auto">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-primary">Edit Topik</h2>
        <p class="text-secondary text-sm">Update informasi topik.</p>
    </div>

    <div class="p-6 bg-surface border border-border rounded-xl shadow-sm">
        <form action="{{ route('course_admin.management.courses.topics.update', [$course, $topic]) }}" method="POST">
            @csrf
            @method('PUT')
            @include('course_admin.dashboard.course_management.topics._form')
        </form>
    </div>
</div>
@endsection