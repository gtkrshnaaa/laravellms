@extends('layouts.sysadmin')
@section('title', 'Edit Kategori')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-primary">Edit Kategori</h2>
        <p class="text-secondary text-sm">Perbarui informasi kategori: <span class="font-mono text-primary">{{ $category->name }}</span></p>
    </div>
    <div class="p-6 bg-surface border border-border rounded-xl shadow-sm">
        <form action="{{ route('sysadmin.manage-categories.update', $category) }}" method="POST">
            @method('PUT')
            @include('sysadmin.dashboard.course_category_management._form')
        </form>
    </div>
</div>
@endsection