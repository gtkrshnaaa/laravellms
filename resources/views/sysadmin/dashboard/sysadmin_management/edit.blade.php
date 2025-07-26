@extends('layouts.sysadmin')

@section('content')
<div class="p-6 max-w-xl">
    <h2 class="text-xl font-bold mb-6">Edit System Admin</h2>

    <form action="{{ route('sysadmin.manage_sysadmin.update', $sysadmin->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-1 font-medium" for="name">Nama</label>
            <input
                type="text"
                id="name"
                name="name"
                class="w-full border border-gray-300 px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                value="{{ old('name', $sysadmin->name) }}"
                required
            >
            @error('name')
                <p class="text-gray-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium" for="email">Email</label>
            <input
                type="email"
                id="email"
                name="email"
                class="w-full border border-gray-300 px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                value="{{ old('email', $sysadmin->email) }}"
                required
            >
            @error('email')
                <p class="text-gray-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium" for="password">Password (kosongkan jika tidak ingin mengganti)</label>
            <input
                type="password"
                id="password"
                name="password"
                class="w-full border border-gray-300 px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
            >
            @error('password')
                <p class="text-gray-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block mb-1 font-medium" for="password_confirmation">Konfirmasi Password (password baru)</label>
            <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                class="w-full border border-gray-300 px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
            >
        </div>

        {{-- Checkbox Show Password --}}
        <div class="mb-6">
            <label class="inline-flex items-center">
                <input type="checkbox" class="mr-2" onclick="togglePasswordVisibility()">
                <span class="text-sm text-gray-700">Tampilkan password</span>
            </label>
        </div>

        <button
            type="submit"
            class="bg-black text-white font-semibold px-6 py-2 rounded"
        >
            Update Admin
        </button>
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
