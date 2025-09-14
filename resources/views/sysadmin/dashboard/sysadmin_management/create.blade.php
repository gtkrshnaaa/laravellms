@extends('layouts.sysadmin')

@section('content')
<div class="p-6 max-w-xl">
    <h2 class="text-xl font-bold mb-4 text-black">Tambah System Admin Baru</h2>

    <form action="{{ route('sysadmin.manage_sysadmin.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block mb-1 font-medium text-black">Nama</label>
            <input type="text" name="name" class="w-full border border-blue-100 px-3 py-2 rounded focus:outline-none focus:border-blue-500" value="{{ old('name') }}">
            @error('name') <p class="text-gray-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium text-black">Email</label>
            <input type="email" name="email" class="w-full border border-blue-100 px-3 py-2 rounded focus:outline-none focus:border-blue-500" value="{{ old('email') }}">
            @error('email') <p class="text-gray-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium text-black">Password</label>
            <input type="password" id="password" name="password" class="w-full border border-blue-100 px-3 py-2 rounded focus:outline-none focus:border-blue-500">
            @error('password') <p class="text-gray-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium text-black">Konfirmasi Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="w-full border border-blue-100 px-3 py-2 rounded focus:outline-none focus:border-blue-500">
        </div>

        <div class="mb-4">
            <label class="inline-flex items-center">
                <input type="checkbox" class="mr-2 text-blue-600 focus:ring-blue-500" onclick="togglePasswordVisibility()">
                <span class="text-sm text-gray-600">Tampilkan password</span>
            </label>
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Save</button>
        <a href="{{ route('sysadmin.manage_sysadmin.index') }}" class="ml-2 text-gray-600 hover:text-black px-4 py-2">Cancel</a>
    </form>
</div>

{{-- Script untuk toggle password --}}
<script>
    function togglePasswordVisibility() {
        const pw = document.getElementById('password');
        const pwConf = document.getElementById('password_confirmation');
        const type = pw.type === 'password' ? 'text' : 'password';
        pw.type = type;
        pwConf.type = type;
    }
</script>
@endsection

