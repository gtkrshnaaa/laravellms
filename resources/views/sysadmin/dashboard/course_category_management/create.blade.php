@extends('layouts.sysadmin')
@section('title', 'Tambah Kategori Baru')

@section('content')
<div class="max-w-xl">
    <h2 class="text-2xl font-bold mb-4">Tambah Kategori Baru</h2>
    <div class="bg-white p-6 rounded-lg border-2 border-gray-100">
        <form action="{{ route('sysadmin.manage-categories.store') }}" method="POST">
            @include('sysadmin.dashboard.course_category_management._form')
        </form>
    </div>
</div>
@endsection