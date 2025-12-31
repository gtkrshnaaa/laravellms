@extends('layouts.sysadmin')
@section('title', 'Tambah Kategori Baru')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-primary">Tambah Kategori Baru</h2>
        <p class="text-secondary text-sm">Tambahkan kategori baru untuk mengelompokkan kursus.</p>
    </div>
    <div class="p-6 bg-surface border border-border rounded-xl shadow-sm">
        <form action="{{ route('sysadmin.manage-categories.store') }}" method="POST">
            @include('sysadmin.dashboard.course_category_management._form')
        </form>
    </div>
</div>
@endsection