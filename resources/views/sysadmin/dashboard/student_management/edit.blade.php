@extends('layouts.sysadmin')
@section('title', 'Edit Siswa')
@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-primary">Edit Data Siswa</h2>
        <p class="text-secondary text-sm">Perbarui informasi untuk akun siswa: <span class="font-mono text-primary">{{ $student->name }}</span></p>
    </div>

    <div class="p-6 bg-surface border border-border rounded-xl shadow-sm">
        <form action="{{ route('sysadmin.manage_student.update', $student->id) }}" method="POST">
            @method('PUT')
            @include('sysadmin.dashboard.student_management._form', ['student' => $student])
        </form>
    </div>
</div>
@endsection
