@extends('layouts.sysadmin')
@section('title', 'Tambah Course Admin')
@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-primary">Tambah Course Admin</h2>
        <p class="text-secondary text-sm">Buat akun untuk admin kursus baru.</p>
    </div>
    
    <div class="p-6 bg-surface border border-border rounded-xl shadow-sm">
        <form action="{{ route('sysadmin.manage_course_admin.store') }}" method="POST">
            @csrf
            @include('sysadmin.dashboard.course_admin_management._form')
        </form>
    </div>
</div>
@endsection