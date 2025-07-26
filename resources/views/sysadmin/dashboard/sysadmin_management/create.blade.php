@extends('layouts.sysadmin')

@section('content')
<div class="p-6 max-w-xl">
    <h2 class="text-xl font-bold mb-4">Tambah System Admin Baru</h2>

    <form action="{{ route('sysadmin.manage_sysadmin.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block mb-1 font-medium">Nama</label>
            <input type="text" name="name" class="w-full border px-3 py-2 rounded" value="{{ old('name') }}">
            @error('name') <p class="text-gray-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium">Email</label>
            <input type="email" name="email" class="w-full border px-3 py-2 rounded" value="{{ old('email') }}">
            @error('email') <p class="text-gray-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium">Password</label>
            <input type="password" id="password" name="password" class="w-full border px-3 py-2 rounded">
            @error('password') <p class="text-gray-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium">Konfirmasi Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="w-full border px-3 py-2 rounded">
        </div>

        <div class="mb-4">
            <label class="inline-flex items-center">
                <input type="checkbox" class="mr-2" onclick="togglePasswordVisibility()">
                <span class="text-sm text-gray-700">Tampilkan password</span>
            </label>
        </div>

        <button type="submit" class="bg-black text-white px-4 py-2 rounded">Save</button>
        <a href="{{ route('sysadmin.manage_sysadmin.index') }}" class="ml-2 bg-gray-300 text-gray-900 px-4 py-2 rounded">Cancel</a>
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
