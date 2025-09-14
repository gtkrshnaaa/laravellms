@extends('layouts.sysadmin')
@section('title', 'Manajemen Siswa')
@section('content')
<div class="flex justify-between items-center mb-4">
    <h2 class="text-2xl font-bold text-black">Manajemen Siswa (Student)</h2>
    <a href="{{ route('sysadmin.manage_student.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded inline-block">+ Tambah Siswa</a>
</div>

@if (session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
@endif

<div class="bg-white border border-blue-100 rounded overflow-x-auto">
    <table class="w-full text-left">
        <thead class="bg-blue-50">
            <tr>
                <th class="border-b p-4 text-gray-600">Nama</th>
                <th class="border-b p-4 text-gray-600">Email</th>
                <th class="border-b p-4 text-gray-600">Tanggal Bergabung</th>
                <th class="border-b p-4 text-gray-600">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-blue-100">
            @forelse ($students as $student)
                <tr>
                    <td class="p-4 text-black">{{ $student->name }}</td>
                    <td class="p-4 text-gray-600">{{ $student->email }}</td>
                    <td class="p-4 text-gray-600">{{ $student->created_at->format('d M Y') }}</td>
                    <td class="p-4 space-x-2">
                        <a href="{{ route('sysadmin.manage_student.edit', $student) }}" class="text-blue-600 hover:underline">Edit</a>
                        <form action="{{ route('sysadmin.manage_student.destroy', $student) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus siswa ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-600 hover:text-black">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="p-4 text-center text-gray-600">Tidak ada data Siswa.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">
    {{ $students->links() }}
</div>
@endsection

