@extends('layouts.admin')

@section('title', 'Kelola Paket Layanan')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-primary">Paket Layanan</h2>
            <p class="text-sm text-secondary">Kelola paket untuk setiap jenis layanan.</p>
        </div>
        <a href="{{ route('admin.service.packages.create', request()->has('service_type_slug') ? ['service_type_slug' => request()->service_type_slug] : []) }}" 
           class="inline-flex items-center gap-2 bg-primary text-background px-4 py-2 rounded-lg text-sm font-medium hover:opacity-90 transition-opacity">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Tambah Paket
        </a>
    </div>

    <!-- Filter (Optional visual reinforcement) -->
    @if(request()->has('service_type_slug'))
    <div class="bg-surface border border-border rounded-lg p-4 flex items-center justify-between">
        <div class="flex items-center gap-2 text-sm text-secondary">
             <span class="font-medium text-primary">Filter:</span>
             <span class="bg-primary/10 text-primary px-2 py-1 rounded">
                 {{ ucwords(str_replace('-', ' ', request()->service_type_slug)) }}
             </span>
        </div>
        <a href="{{ route('admin.service.packages.index') }}" class="text-xs text-secondary hover:text-primary hover:underline">Clear Filter</a>
    </div>
    @endif

    <!-- Table -->
    <div class="bg-surface border border-border rounded-xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="bg-background border-b border-border">
                        <th class="px-6 py-4 font-medium text-secondary">Nama Paket</th>
                        <th class="px-6 py-4 font-medium text-secondary">Jenis Layanan</th>
                        <th class="px-6 py-4 font-medium text-secondary">Harga</th>
                        <th class="px-6 py-4 font-medium text-secondary">Durasi</th>
                        <th class="px-6 py-4 font-medium text-secondary">Status</th>
                        <th class="px-6 py-4 font-medium text-secondary text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    @forelse($packages as $package)
                    <tr class="hover:bg-background/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="font-bold text-primary">{{ $package->name }}</div>
                            <div class="text-xs text-secondary truncate max-w-xs">{{ $package->description }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-secondary/10 text-secondary">
                                {{ $package->serviceType->name }}
                            </span>
                        </td>
                        <td class="px-6 py-4 font-mono text-primary">
                            {{ $package->price ? 'Rp ' . number_format($package->price, 0, ',', '.') : 'Gratis' }}
                        </td>
                        <td class="px-6 py-4 text-secondary">
                            {{ $package->duration_days }} Hari
                        </td>
                        <td class="px-6 py-4">
                            @if($package->is_active)
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-green-500/10 text-green-500 border border-green-500/20">
                                    Active
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-secondary/10 text-secondary border border-border">
                                    Inactive
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.service.packages.edit', $package->id) }}" class="p-2 text-secondary hover:text-blue-500 hover:bg-blue-500/10 rounded-lg transition-colors" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                </a>
                                <form action="{{ route('admin.service.packages.destroy', $package->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus paket ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-secondary hover:text-red-500 hover:bg-red-500/10 rounded-lg transition-colors" title="Hapus">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-secondary">
                            <p class="mb-2">Belum ada paket layanan.</p>
                            @if(request()->has('service_type_slug'))
                                <a href="{{ route('admin.service.packages.create', ['service_type_slug' => request()->service_type_slug]) }}" class="text-primary font-medium hover:underline">Tambah Paket Baru</a>
                            @else
                                <a href="{{ route('admin.service.packages.create') }}" class="text-primary font-medium hover:underline">Tambah Paket Baru</a>
                            @endif
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
