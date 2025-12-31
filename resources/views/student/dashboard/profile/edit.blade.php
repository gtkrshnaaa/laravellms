@extends('layouts.student')

@section('title', 'Profil Saya')

@section('content')
    <h1 class="text-3xl font-bold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-gray-900 to-gray-600 dark:from-white dark:to-gray-400 mb-8">Profil Saya</h1>
    <div class="bg-surface p-8 rounded-2xl border border-border max-w-2xl relative overflow-hidden shadow-sm">
        {{-- Gradient Overlay --}}
        <div class="absolute top-0 right-0 w-64 h-64 bg-primary/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 pointer-events-none"></div>

        @if (session('success'))
            <div class="bg-green-500/10 border border-green-500/20 text-green-600 p-4 mb-6 rounded-xl flex items-center gap-2" role="alert">
                <i class="uil uil-check-circle text-xl"></i>
                <p>{{ session('success') }}</p>
            </div>
        @endif
        <form action="{{ route('student.profile.update') }}" method="POST" class="space-y-6 relative z-10">
            @csrf
            @method('PUT')
            
            <div>
                <label for="name" class="block text-sm font-bold text-primary mb-2">Nama Lengkap</label>
                <input type="text" name="name" id="name" value="{{ old('name', $student->name) }}" required class="block w-full px-4 py-3 bg-background border border-border rounded-xl text-primary placeholder-secondary focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none transition-all">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            
            <div>
                <label for="email" class="block text-sm font-bold text-primary mb-2">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $student->email) }}" required class="block w-full px-4 py-3 bg-background border border-border rounded-xl text-primary placeholder-secondary focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none transition-all">
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="division" class="block text-sm font-bold text-primary mb-2">Divisi / Departemen</label>
                <select name="division" id="division" class="block w-full px-4 py-3 bg-background border border-border rounded-xl text-primary placeholder-secondary focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none transition-all">
                    <option value="">-- Pilih Divisi --</option>
                    @foreach(['IT', 'Marketing', 'HR', 'Finance', 'Operations'] as $div)
                        <option value="{{ $div }}" {{ old('division', $student->division) == $div ? 'selected' : '' }}>{{ $div }}</option>
                    @endforeach
                </select>
                @error('division') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <hr class="my-6 border-border">

            <div class="flex items-center gap-2 mb-4">
                <i class="uil uil-lock text-secondary text-lg"></i>
                <p class="text-primary font-bold">Ganti Password</p>
                <span class="text-xs text-secondary">(isi jika ingin mengubah)</span>
            </div>

            <div>
                <label for="password" class="block text-sm font-bold text-primary mb-2">Password Baru</label>
                <input type="password" name="password" id="password" class="block w-full px-4 py-3 bg-background border border-border rounded-xl text-primary placeholder-secondary focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none transition-all">
                 @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            
            <div>
                <label for="password_confirmation" class="block text-sm font-bold text-primary mb-2">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="block w-full px-4 py-3 bg-background border border-border rounded-xl text-primary placeholder-secondary focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none transition-all">
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full sm:w-auto inline-flex justify-center items-center py-3 px-8 rounded-xl bg-primary text-background font-bold hover:bg-primary/90 transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                    <i class="uil uil-save mr-2"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
@endsection