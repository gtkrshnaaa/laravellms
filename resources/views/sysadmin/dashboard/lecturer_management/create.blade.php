{{-- FILE: resources/views/sysadmin/dashboard/lecturer_management/create.blade.php --}}
@extends('layouts.sysadmin')
@section('title', 'Tambah Dosen')
@section('content')
<div class="p-6 max-w-xl bg-white rounded shadow">
    <h2 class="text-xl font-bold mb-4">Tambah Dosen Baru</h2>
    <form action="{{ route('sysadmin.manage_lecturer.store') }}" method="POST">
        @csrf
        @include('sysadmin.dashboard.lecturer_management._form')
    </form>
</div>
@endsection