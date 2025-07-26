{{-- FILE: resources/views/sysadmin/dashboard/lecturer_management/edit.blade.php --}}
@extends('layouts.sysadmin')
@section('title', 'Edit Dosen')
@section('content')
<div class="p-6 max-w-xl bg-white rounded shadow">
    <h2 class="text-xl font-bold mb-4">Edit Dosen</h2>
    <form action="{{ route('sysadmin.manage_lecturer.update', $lecturer->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('sysadmin.dashboard.lecturer_management._form', ['edit' => true])
    </form>
</div>
@endsection