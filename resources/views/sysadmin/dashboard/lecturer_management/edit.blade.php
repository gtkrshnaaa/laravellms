@extends('layouts.sysadmin')
@section('title', 'Edit Dosen')
@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-primary">Edit Data Dosen</h2>
        <p class="text-secondary text-sm">Perbarui informasi untuk akun dosen: <span class="font-mono text-primary">{{ $lecturer->name }}</span></p>
    </div>

    <div class="p-6 bg-surface border border-border rounded-xl shadow-sm">
        <form action="{{ route('sysadmin.manage_lecturer.update', $lecturer->id) }}" method="POST">
            @method('PUT')
            @include('sysadmin.dashboard.lecturer_management._form', ['lecturer' => $lecturer, 'edit' => true])
        </form>
    </div>
</div>
@endsection