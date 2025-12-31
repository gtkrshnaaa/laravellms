{{-- FILE: resources/views/sysadmin/dashboard/course_admin_management/edit.blade.php --}}
@extends('layouts.sysadmin')
@section('title', 'Edit Course Admin')
@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-primary">Edit Course Admin</h2>
        <p class="text-secondary text-sm">Perbarui informasi untuk admin: <span class="font-mono text-primary">{{ $courseAdmin->name }}</span></p>
    </div>

    <div class="p-6 bg-surface border border-border rounded-xl shadow-sm">
        <form action="{{ route('sysadmin.manage_course_admin.update', $courseAdmin->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('sysadmin.dashboard.course_admin_management._form', ['edit' => true])
        </form>
    </div>
</div>
@endsection