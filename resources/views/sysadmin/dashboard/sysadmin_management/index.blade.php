@extends('layouts.sysadmin')
@section('title', 'Manajemen System Admin')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-2xl font-bold text-primary">Manajemen System Admin</h2>
        <p class="text-secondary text-sm">Kelola akun administrator sistem.</p>
    </div>
    <a href="{{ route('sysadmin.manage_sysadmin.create') }}" class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-lg font-semibold text-xs text-background uppercase tracking-widest hover:bg-primary/90 active:bg-primary focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 transition ease-in-out duration-150">
        + Tambah Admin
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
                    <th class="px-6 py-4 font-semibold text-secondary uppercase tracking-wider text-xs text-center">Level</th>
                    <th class="px-6 py-4 font-semibold text-secondary uppercase tracking-wider text-xs text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border">
                @forelse ($sysadmins as $sysadmin)
                    <tr class="hover:bg-primary/5 transition-colors">
                        <td class="px-6 py-4 text-primary font-medium">{{ $sysadmin->name }}</td>
                        <td class="px-6 py-4 text-secondary">{{ $sysadmin->email }}</td>
                        <td class="px-6 py-4 text-center">
                            @if ($sysadmin->level === 'superadmin')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-500/10 text-purple-700 dark:text-purple-400 border border-purple-500/20">
                                    Super Admin
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-500/10 text-blue-700 dark:text-blue-400 border border-blue-500/20">
                                    Admin
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 space-x-2 text-right">
                            <a href="{{ route('sysadmin.manage_sysadmin.edit', $sysadmin) }}" class="text-blue-500 hover:text-blue-600 transition-colors font-medium text-xs">Edit</a>

                            @if ($sysadmin->level !== 'superadmin')
                                <form action="{{ route('sysadmin.manage_sysadmin.destroy', $sysadmin) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus admin ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-600 transition-colors font-medium ml-2 text-xs">Hapus</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-secondary">
                            <div class="flex flex-col items-center justify-center">
                                <span class="block mb-2 text-2xl text-secondary/30">☹</span>
                                Tidak ada admin.
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

