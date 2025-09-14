@extends('layouts.sysadmin')
@section('title', 'Edit Kategori')

@section('content')
<div class="max-w-xl">
    <h2 class="text-2xl font-bold mb-4 text-black">Edit Kategori: {{ $category->name }}</h2>
    <div class="bg-white p-6 rounded-lg border border-blue-100">
        <form action="{{ route('sysadmin.manage-categories.update', $category) }}" method="POST">
            @method('PUT')
            @include('sysadmin.dashboard.course_category_management._form')
        </form>
    </div>
</div>
@endsection