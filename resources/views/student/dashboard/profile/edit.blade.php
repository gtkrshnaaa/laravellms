@extends('layouts.student')

@section('title', 'Profil Saya')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Profil Saya</h1>
    <div class="bg-white p-8 rounded-lg border-2 border-gray-100 max-w-2xl">
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif
        <form action="{{ route('student.profile.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" name="name" id="name" value="{{ old('name', $student->name) }}" required class="mt-1 block w-full px-3 py-2 border @error('name') border-gray-500 @else border-gray-300 @enderror rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500">
                @error('name') <p class="text-gray-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            
             <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $student->email) }}" required class="mt-1 block w-full px-3 py-2 border @error('email') border-gray-500 @else border-gray-300 @enderror rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500">
                @error('email') <p class="text-gray-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <hr class="my-4">

            <p class="text-gray-600">Ganti Password (isi jika ingin mengubah)</p>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password Baru</label>
                <input type="password" name="password" id="password" class="mt-1 block w-full px-3 py-2 border @error('password') border-gray-500 @else border-gray-300 @enderror rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500">
                 @error('password') <p class="text-gray-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500">
            </div>

            <div>
                <button type="submit" class="inline-flex justify-center py-2 px-6 border border-transparent rounded-md font-bold text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
@endsection