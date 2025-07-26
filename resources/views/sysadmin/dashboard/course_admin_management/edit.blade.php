{{-- FILE: resources/views/sysadmin/dashboard/course_admin_management/edit.blade.php --}}
@extends('layouts.sysadmin')
@section('title', 'Edit Course Admin')
@section('content')
<div class="p-6 max-w-xl bg-white rounded shadow">
    <h2 class="text-xl font-bold mb-4">Edit Course Admin</h2>
    <form action="{{ route('sysadmin.manage_course_admin.update', $courseAdmin->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('sysadmin.dashboard.course_admin_management._form', ['edit' => true])
    </form>
</div>
@endsection