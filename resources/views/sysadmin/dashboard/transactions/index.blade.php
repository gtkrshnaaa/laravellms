@extends('layouts.sysadmin')
@section('title', 'Monitoring Transaksi')

@section('content')
<h1 class="text-2xl font-bold mb-4">Monitoring Transaksi</h1>

{{-- STATS CARDS --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="bg-white p-4 rounded-lg border-2 border-gray-100">
        <h3 class="text-sm text-gray-500">Total Pendapatan</h3>
        <p class="text-2xl font-bold">Rp{{ number_format($totalRevenue, 0, ',', '.') }}</p>
    </div>
    <div class="bg-white p-4 rounded-lg border-2 border-gray-100">
        <h3 class="text-sm text-gray-500">Transaksi Berhasil</h3>
        <p class="text-2xl font-bold text-green-600">{{ $successfulTransactions }}</p>
    </div>
    <div class="bg-white p-4 rounded-lg border-2 border-gray-100">
        <h3 class="text-sm text-gray-500">Transaksi Pending</h3>
        <p class="text-2xl font-bold text-yellow-600">{{ $pendingTransactions }}</p>
    </div>
    <div class="bg-white p-4 rounded-lg border-2 border-gray-100">
        <h3 class="text-sm text-gray-500">Transaksi Gagal</h3>
        <p class="text-2xl font-bold text-gray-600">{{ $failedTransactions }}</p>
    </div>
</div>

{{-- FILTER & SEARCH --}}
<div class="bg-white p-4 rounded-lg border-2 border-gray-100 mb-6">
    <form action="{{ route('sysadmin.transactions.index') }}" method="GET">
        <div class="flex space-x-4 items-end">
            <div class="flex-1">
                <label for="search" class="text-sm font-medium">Cari (ID Order / Nama Siswa)</label>
                <input type="text" name="search" id="search" class="w-full border px-3 py-2 rounded-md" value="{{ request('search') }}" placeholder="Contoh: 1a2b3c4d...">
            </div>
            <div class="flex-1">
                <label for="status" class="text-sm font-medium">Status</label>
                <select name="status" id="status" class="w-full border px-3 py-2 rounded-md">
                    <option value="">Semua Status</option>
                    <option value="paid" @if(request('status') == 'paid') selected @endif>Paid</option>
                    <option value="pending" @if(request('status') == 'pending') selected @endif>Pending</option>
                    <option value="failed" @if(request('status') == 'failed') selected @endif>Failed</option>
                </select>
            </div>
            <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-md">Filter</button>
            <a href="{{ route('sysadmin.transactions.index') }}" class="bg-gray-200 text-gray-800 px-4 py-2 rounded-md">Reset</a>
        </div>
    </form>
</div>

@if(session('success')) <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div> @endif
@if(session('error')) <div class="bg-gray-100 text-gray-700 p-3 rounded mb-4">{{ session('error') }}</div> @endif
@if(session('info')) <div class="bg-blue-100 text-blue-700 p-3 rounded mb-4">{{ session('info') }}</div> @endif

{{-- DATA TABLE --}}
<div class="bg-white border-2 border-gray-100 rounded overflow-x-auto">
    <table class="w-full text-left">
        <thead class="bg-gray-50">
            <tr>
                <th class="p-4 font-semibold text-sm">ID Order</th>
                <th class="p-4 font-semibold text-sm">Tanggal</th>
                <th class="p-4 font-semibold text-sm">Siswa</th>
                <th class="p-4 font-semibold text-sm">Kursus</th>
                <th class="p-4 font-semibold text-sm">Jumlah</th>
                <th class="p-4 font-semibold text-sm">Status</th>
                <th class="p-4 font-semibold text-sm">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse ($orders as $order)
                <tr>
                    <td class="p-4 text-gray-600 font-mono text-xs">{{ $order->id }}</td>
                    <td class="p-4 text-gray-600 whitespace-nowrap">{{ $order->created_at->format('d M Y, H:i') }}</td>
                    <td class="p-4 font-medium">{{ $order->student->name ?? 'N/A' }}</td>
                    <td class="p-4 text-gray-600">{{ $order->course->name ?? 'N/A' }}</td>
                    <td class="p-4 text-gray-600">Rp{{ number_format($order->amount, 0, ',', '.') }}</td>
                    <td class="p-4">
                        @if($order->status == 'paid')
                            <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">Paid</span>
                        @elseif($order->status == 'pending')
                            <span class="px-2 py-1 text-xs font-semibold text-yellow-800 bg-yellow-100 rounded-full">Pending</span>
                        @else
                            <span class="px-2 py-1 text-xs font-semibold text-gray-800 bg-gray-100 rounded-full">Failed</span>
                        @endif
                    </td>
                    <td class="p-4 space-x-2 whitespace-nowrap">
                        <a href="{{ route('sysadmin.transactions.show', $order) }}" class="text-blue-600 hover:underline">Detail</a>
                        @if($order->status == 'pending')
                        <form action="{{ route('sysadmin.transactions.sync', $order) }}" method="POST" class="inline" onsubmit="return confirm('Anda yakin ingin menyinkronkan status transaksi ini dengan Midtrans?')">
                            @csrf
                            <button type="submit" class="text-purple-600 hover:underline">Sync</button>
                        </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="p-4 text-center text-gray-500">Tidak ada data transaksi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">
    {{ $orders->links() }}
</div>
@endsection