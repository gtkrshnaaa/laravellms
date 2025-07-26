@extends('layouts.sysadmin')
@section('title', 'Edit Siswa')
@section('content')
<div class="p-6 max-w-xl bg-white rounded-lg border-2 border-gray-100">
    <h2 class="text-xl font-bold mb-4">Edit Siswa: {{ $student->name }}</h2>
    <form action="{{ route('sysadmin.manage_student.update', $student->id) }}" method="POST">
        @method('PUT')
        @include('sysadmin.dashboard.student_management._form', ['student' => $student])
    </form>
</div>
@endsection
