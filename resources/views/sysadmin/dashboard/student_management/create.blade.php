@extends('layouts.sysadmin')
@section('title', 'Tambah Siswa')
@section('content')
<div class="p-6 max-w-xl bg-white rounded-lg border-2 border-gray-100">
    <h2 class="text-xl font-bold mb-4">Tambah Siswa Baru</h2>
    <form action="{{ route('sysadmin.manage_student.store') }}" method="POST">
        @include('sysadmin.dashboard.student_management._form')
    </form>
</div>
@endsection
