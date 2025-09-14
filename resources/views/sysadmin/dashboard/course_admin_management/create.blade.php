{{-- FILE: resources/views/sysadmin/dashboard/course_admin_management/create.blade.php --}}
@extends('layouts.sysadmin')
@section('title', 'Tambah Course Admin')
@section('content')
<div class="p-6 max-w-xl bg-white rounded border border-blue-100">
    <h2 class="text-xl font-bold mb-4 text-black">Tambah Course Admin Baru</h2>
    <form action="{{ route('sysadmin.manage_course_admin.store') }}" method="POST">
        @csrf
        @include('sysadmin.dashboard.course_admin_management._form')
    </form>
</div>
@endsection