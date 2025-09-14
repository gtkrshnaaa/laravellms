@extends('layouts.student')

@section('title', 'Profil Saya')

@section('content')
    <h1 class="text-3xl font-bold text-black mb-6">Profil Saya</h1>
    <div class="bg-white p-8 rounded-lg border border-blue-100 max-w-2xl">
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif
        <form action="{{ route('student.profile.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div>
                <label for="name" class="block text-sm font-medium text-black">Nama Lengkap</label>
                <input type="text" name="name" id="name" value="{{ old('name', $student->name) }}" required class="mt-1 block w-full px-3 py-2 border @error('name') border-blue-500 @else border-blue-100 @enderror rounded-md focus:outline-none focus:border-blue-500">
                @error('name') <p class="text-gray-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            
             <div>
                <label for="email" class="block text-sm font-medium text-black">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $student->email) }}" required class="mt-1 block w-full px-3 py-2 border @error('email') border-blue-500 @else border-blue-100 @enderror rounded-md focus:outline-none focus:border-blue-500">
                @error('email') <p class="text-gray-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <hr class="my-4 border-blue-100">

            <p class="text-gray-600">Ganti Password (isi jika ingin mengubah)</p>

            <div>
                <label for="password" class="block text-sm font-medium text-black">Password Baru</label>
                <input type="password" name="password" id="password" class="mt-1 block w-full px-3 py-2 border @error('password') border-blue-500 @else border-blue-100 @enderror rounded-md focus:outline-none focus:border-blue-500">
                 @error('password') <p class="text-gray-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-black">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full px-3 py-2 border border-blue-100 rounded-md focus:outline-none focus:border-blue-500">
            </div>

            <div>
                <button type="submit" class="inline-flex justify-center py-2 px-6 border border-blue-600 rounded-md font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
@endsection