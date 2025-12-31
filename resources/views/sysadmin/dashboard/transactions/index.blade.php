@extends('layouts.sysadmin')
@section('title', 'Monitoring Transaksi')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-primary mb-2">Monitoring Transaksi</h2>
    <p class="text-secondary text-sm">Pantau semua transaksi masuk, status pembayaran, dan pendapatan real-time.</p>
</div>

{{-- STATS CARDS --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-surface border border-border p-6 rounded-xl relative overflow-hidden group hover:border-primary/20 shadow-sm hover:shadow-md transition-all duration-300">
        <h3 class="text-secondary text-xs uppercase tracking-widest font-bold mb-2">Total Pendapatan</h3>
        <p class="text-2xl font-bold text-primary font-mono">Rp{{ number_format($totalRevenue, 0, ',', '.') }}</p>
    </div>
    <div class="bg-surface border border-border p-6 rounded-xl relative overflow-hidden group hover:border-green-500/20 shadow-sm hover:shadow-md transition-all duration-300">
        <h3 class="text-secondary text-xs uppercase tracking-widest font-bold mb-2">Transaksi Berhasil</h3>
        <p class="text-3xl font-bold text-green-500 font-mono">{{ $successfulTransactions }}</p>
    </div>
    <div class="bg-surface border border-border p-6 rounded-xl relative overflow-hidden group hover:border-yellow-500/20 shadow-sm hover:shadow-md transition-all duration-300">
        <h3 class="text-secondary text-xs uppercase tracking-widest font-bold mb-2">Tertunda (Pending)</h3>
        <p class="text-3xl font-bold text-yellow-500 font-mono">{{ $pendingTransactions }}</p>
    </div>
    <div class="bg-surface border border-border p-6 rounded-xl relative overflow-hidden group hover:border-red-500/20 shadow-sm hover:shadow-md transition-all duration-300">
        <h3 class="text-secondary text-xs uppercase tracking-widest font-bold mb-2">Gagal / Batal</h3>
        <p class="text-3xl font-bold text-secondary font-mono">{{ $failedTransactions }}</p>
    </div>
</div>

{{-- FILTER & SEARCH --}}
<div class="bg-surface border border-border p-6 rounded-xl mb-8 shadow-sm">
    <form action="{{ route('sysadmin.transactions.index') }}" method="GET">
        <div class="flex flex-col md:flex-row gap-4 items-end">
            <div class="flex-1 w-full">
                <label for="search" class="block text-xs font-bold text-secondary uppercase tracking-wider mb-2">Cari Transaksi</label>
                <input type="text" name="search" id="search" 
                    class="w-full bg-background border border-border rounded-lg px-4 py-2.5 text-primary placeholder-secondary/50 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors duration-200" 
                    value="{{ request('search') }}" 
                    placeholder="Masukkan ID Order atau Nama Siswa...">
            </div>
            <div class="w-full md:w-48">
                <label for="status" class="block text-xs font-bold text-secondary uppercase tracking-wider mb-2">Status</label>
                <select name="status" id="status" class="w-full bg-background border border-border rounded-lg px-4 py-2.5 text-primary focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors duration-200">
                    <option value="">Semua Status</option>
                    <option value="paid" @if(request('status') == 'paid') selected @endif>Paid</option>
                    <option value="pending" @if(request('status') == 'pending') selected @endif>Pending</option>
                    <option value="failed" @if(request('status') == 'failed') selected @endif>Failed</option>
                </select>
            </div>
            <button type="submit" class="px-6 py-2.5 bg-primary text-background font-medium rounded-lg hover:bg-primary/90 transition-colors focus:ring-2 focus:ring-primary focus:ring-offset-2">
                Filter
            </button>
            <a href="{{ route('sysadmin.transactions.index') }}" class="px-6 py-2.5 bg-surface border border-border text-secondary font-medium rounded-lg hover:text-primary hover:border-primary transition-colors focus:ring-2 focus:ring-border">
                Reset
            </a>
        </div>
    </form>
</div>

@if(session('success')) <div class="bg-green-500/10 border border-green-500/50 text-green-700 dark:text-green-400 p-4 rounded-lg mb-6" role="alert">{{ session('success') }}</div> @endif
@if(session('error')) <div class="bg-red-500/10 border border-red-500/50 text-red-700 dark:text-red-400 p-4 rounded-lg mb-6" role="alert">{{ session('error') }}</div> @endif
@if(session('info')) <div class="bg-blue-500/10 border border-blue-500/50 text-blue-700 dark:text-blue-400 p-4 rounded-lg mb-6" role="alert">{{ session('info') }}</div> @endif

{{-- DATA TABLE --}}
<div class="bg-surface border border-border rounded-xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead class="bg-secondary/5 border-b border-border">
                <tr>
                    <th class="px-6 py-4 font-semibold text-secondary uppercase tracking-wider text-xs">ID Order</th>
                    <th class="px-6 py-4 font-semibold text-secondary uppercase tracking-wider text-xs">Waktu</th>
                    <th class="px-6 py-4 font-semibold text-secondary uppercase tracking-wider text-xs">Siswa</th>
                    <th class="px-6 py-4 font-semibold text-secondary uppercase tracking-wider text-xs">Kursus</th>
                    <th class="px-6 py-4 font-semibold text-secondary uppercase tracking-wider text-xs text-right">Jumlah</th>
                    <th class="px-6 py-4 font-semibold text-secondary uppercase tracking-wider text-xs text-center">Status</th>
                    <th class="px-6 py-4 font-semibold text-secondary uppercase tracking-wider text-xs text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border">
                @forelse ($orders as $order)
                    <tr class="hover:bg-primary/5 transition-colors">
                        <td class="px-6 py-4 text-secondary font-mono text-xs">{{ $order->id }}</td>
                        <td class="px-6 py-4 text-secondary whitespace-nowrap">{{ $order->created_at->format('d M Y, H:i') }}</td>
                        <td class="px-6 py-4 text-primary font-medium">{{ $order->student->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-secondary">{{ $order->course->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-primary font-mono text-right">Rp{{ number_format($order->amount, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 text-center">
                            @if($order->status == 'paid')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">Paid</span>
                            @elseif($order->status == 'pending')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400">Pending</span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400">Failed</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 space-x-2 text-right whitespace-nowrap">
                            <a href="{{ route('sysadmin.transactions.show', $order) }}" class="text-blue-500 hover:text-blue-600 transition-colors font-medium text-xs">Detail</a>
                            @if($order->status == 'pending')
                            <form action="{{ route('sysadmin.transactions.sync', $order) }}" method="POST" class="inline" onsubmit="return confirm('Anda yakin ingin menyinkronkan status transaksi ini dengan Midtrans?')">
                                @csrf
                                <button type="submit" class="text-purple-500 hover:text-purple-600 transition-colors font-medium ml-2 text-xs">Sync</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-secondary">
                            <div class="flex flex-col items-center justify-center">
                                <span class="block mb-2 text-2xl text-secondary/30">☹</span>
                                Tidak ada data transaksi.
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">
    {{ $orders->links() }}
</div>
@endsection