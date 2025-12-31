@extends('layouts.sysadmin')
@section('title', 'Manajemen Siswa')
@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-2xl font-bold text-primary">Manajemen Siswa</h2>
        <p class="text-secondary text-sm">Kelola data siswa yang terdaftar di sistem.</p>
    </div>
    <a href="{{ route('sysadmin.manage_student.create') }}" class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-lg font-semibold text-xs text-background uppercase tracking-widest hover:bg-primary/90 active:bg-primary focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 transition ease-in-out duration-150">
        + Tambah Siswa
    </a>
</div>

@if (session('success'))
    <div class="bg-green-500/10 border border-green-500/50 text-green-700 dark:text-green-400 p-4 rounded-lg mb-6" role="alert">
        {{ session('success') }}
    </div>
@endif

<div class="bg-surface border border-border rounded-xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead class="bg-secondary/5 border-b border-border">
                <tr>
                    <th class="px-6 py-4 font-semibold text-secondary uppercase tracking-wider text-xs">Nama</th>
                    <th class="px-6 py-4 font-semibold text-secondary uppercase tracking-wider text-xs">Email</th>
                    <th class="px-6 py-4 font-semibold text-secondary uppercase tracking-wider text-xs">Tanggal Bergabung</th>
                    <th class="px-6 py-4 font-semibold text-secondary uppercase tracking-wider text-xs text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border">
                @forelse ($students as $student)
                    <tr class="hover:bg-primary/5 transition-colors">
                        <td class="px-6 py-4 text-primary font-medium">{{ $student->name }}</td>
                        <td class="px-6 py-4 text-secondary">{{ $student->email }}</td>
                        <td class="px-6 py-4 text-secondary font-mono text-xs">{{ $student->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4 space-x-2 text-right">
                            <a href="{{ route('sysadmin.manage_student.edit', $student) }}" class="text-blue-500 hover:text-blue-600 transition-colors font-medium">Edit</a>
                            <form action="{{ route('sysadmin.manage_student.destroy', $student) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus siswa ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-600 transition-colors font-medium ml-2">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-secondary">
                            <div class="flex flex-col items-center justify-center">
                                <span class="block mb-2 text-2xl text-secondary/30">☹</span>
                                Tidak ada data Siswa.
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">
    {{ $students->links() }}
</div>
@endsection

