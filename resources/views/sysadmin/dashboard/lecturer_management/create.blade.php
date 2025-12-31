@extends('layouts.sysadmin')
@section('title', 'Tambah Dosen')
@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-primary">Tambah Dosen Baru</h2>
        <p class="text-secondary text-sm">Isi formulir berikut untuk menambahkan akun dosen baru.</p>
    </div>
    
    <div class="p-6 bg-surface border border-border rounded-xl shadow-sm">
        <form action="{{ route('sysadmin.manage_lecturer.store') }}" method="POST">
            @include('sysadmin.dashboard.lecturer_management._form')
        </form>
    </div>
</div>
@endsection