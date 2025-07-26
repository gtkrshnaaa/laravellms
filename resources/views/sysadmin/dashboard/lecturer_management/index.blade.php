{{-- FILE: resources/views/sysadmin/dashboard/lecturer_management/index.blade.php --}}
@extends('layouts.sysadmin')
@section('title', 'Manajemen Dosen')
@section('content')
<div class="flex justify-between items-center mb-4">
    <h2 class="text-2xl font-bold">Manajemen Dosen (Lecturer)</h2>
    <a href="{{ route('sysadmin.manage_lecturer.create') }}" class="bg-gray-600 text-white px-4 py-2 rounded inline-block">+ Tambah Dosen</a>
</div>

@if (session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
@endif

<div class="bg-white border-2 border-gray-100 rounded overflow-x-auto">
    <table class="w-full text-left">
        <thead>
            <tr>
                <th class="border-b p-4">Nama</th>
                <th class="border-b p-4">Email</th>
                <th class="border-b p-4">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($lecturers as $lecturer)
                <tr>
                    <td class="border-b p-4">{{ $lecturer->name }}</td>
                    <td class="border-b p-4">{{ $lecturer->email }}</td>
                    <td class="border-b p-4 space-x-2">
                        <a href="{{ route('sysadmin.manage_lecturer.edit', $lecturer) }}" class="text-purple-600 hover:underline">Edit</a>
                        <form action="{{ route('sysadmin.manage_lecturer.destroy', $lecturer) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus dosen ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="p-4 text-center text-gray-500">Tidak ada data Dosen.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">
    {{ $lecturers->links() }}
</div>
@endsection