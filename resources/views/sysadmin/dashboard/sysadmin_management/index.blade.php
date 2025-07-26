@extends('layouts.sysadmin')

@section('content')
<div class="p-6">

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold mb-4">Manajemen System Admin</h2>
        <a href="{{ route('sysadmin.manage_sysadmin.create') }}" class="bg-gray-600 text-white px-4 py-2 rounded mb-4 inline-block">+ Tambah Admin</a>
    </div>
    
    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white border-2 border-gray-100 rounded p-4">
        <table class="w-full text-left">
            <thead>
                <tr>
                    <th class="border-b p-2">Nama</th>
                    <th class="border-b p-2">Email</th>
                    <th class="border-b p-2">Level</th>
                    <th class="border-b p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($sysadmins as $sysadmin)
                    <tr>
                        <td class="border-b p-2">{{ $sysadmin->name }}</td>
                        <td class="border-b p-2">{{ $sysadmin->email }}</td>
                        <td class="border-b p-2">
                            @if ($sysadmin->level === 'superadmin')
                                <span class="bg-purple-300 text-purple-500 bg-opacity-20 px-2 py-1 rounded text-xs font-semibold">Super Admin</span>
                            @else
                                <span class="bg-blue-300 text-blue-500 bg-opacity-20 px-2 py-1 rounded text-xs font-semibold">Admin</span>
                            @endif
                        </td>
                        <td class="border-b p-2 space-x-2">
                            <a href="{{ route('sysadmin.manage_sysadmin.edit', $sysadmin) }}" class="text-purple-600 hover:underline">Edit</a>

                            @if ($sysadmin->level !== 'superadmin')
                                <form action="{{ route('sysadmin.manage_sysadmin.destroy', $sysadmin) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus admin ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-gray-600 hover:underline">Hapus</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-4 text-center text-gray-500">Tidak ada admin</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
