@extends('layouts.sysadmin')
@section('title', 'Detail Transaksi')

@section('content')
<div class="max-w-4xl mx-auto">
    <a href="{{ route('sysadmin.transactions.index') }}" class="inline-flex items-center text-sm text-secondary hover:text-primary transition-colors mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Kembali ke Monitoring
    </a>

    <div class="mb-6">
        <h2 class="text-2xl font-bold text-primary">Detail Transaksi</h2>
        <p class="text-secondary text-sm font-mono mt-1">ID: {{ $order->id }}</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        {{-- Main Info --}}
        <div class="md:col-span-1 space-y-6">
            <div class="bg-surface border border-border rounded-xl shadow-sm p-6">
                <h3 class="font-bold text-primary mb-4 pb-2 border-b border-border">Informasi Order</h3>
                <div class="space-y-3 text-sm">
                    <div>
                        <span class="block text-secondary text-xs">Siswa</span>
                        <span class="font-medium text-primary">{{ $order->student->name }}</span>
                    </div>
                    <div>
                        <span class="block text-secondary text-xs">Kursus</span>
                        <span class="font-medium text-primary">{{ $order->course->name }}</span>
                    </div>
                    <div>
                        <span class="block text-secondary text-xs">Jumlah</span>
                        <span class="font-bold text-primary text-base">Rp{{ number_format($order->amount, 0, ',', '.') }}</span>
                    </div>
                    <div>
                        <span class="block text-secondary text-xs">Tanggal</span>
                        <span class="font-medium text-primary">{{ $order->created_at->format('d M Y, H:i:s') }}</span>
                    </div>
                    <div>
                        <span class="block text-secondary text-xs mb-1">Status</span>
                        @if($order->status == 'paid')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-500/10 text-green-700 dark:text-green-400 border border-green-500/20">PAID</span>
                        @elseif($order->status == 'pending')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-500/10 text-yellow-700 dark:text-yellow-400 border border-yellow-500/20">PENDING</span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-500/10 text-red-700 dark:text-red-400 border border-red-500/20">FAILED</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="bg-surface border border-border rounded-xl shadow-sm p-6">
                <h3 class="font-bold text-primary mb-4 pb-2 border-b border-border">Aksi</h3>
                @if($order->status == 'pending')
                    <form action="{{ route('sysadmin.transactions.sync', $order) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menyinkronkan status transaksi ini dengan Midtrans?')">
                        @csrf
                        <button type="submit" class="w-full flex justify-center items-center px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Sinkronkan Status (Midtrans)
                        </button>
                    </form>
                    <p class="text-xs text-secondary mt-3 text-center">
                        Gunakan tombol ini jika status di sistem belum terupdate otomatis.
                    </p>
                @else
                    <div class="text-center py-4">
                        <p class="text-sm text-secondary">Tidak ada aksi yang tersedia untuk status <span class="font-bold uppercase text-primary">'{{ $order->status }}'</span>.</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Technical Details --}}
        <div class="md:col-span-2">
            <div class="bg-surface border border-border rounded-xl shadow-sm p-6">
                <h3 class="font-bold text-primary mb-4 pb-2 border-b border-border flex items-center justify-between">
                    <span>Raw Payment Payload</span>
                    <span class="text-xs font-normal text-secondary bg-secondary/10 px-2 py-1 rounded">Dari Midtrans</span>
                </h3>
                <div class="relative bg-gray-900 rounded-lg overflow-hidden">
                    <div class="absolute top-2 right-2 flex space-x-1">
                        <div class="w-2.5 h-2.5 rounded-full bg-red-500"></div>
                        <div class="w-2.5 h-2.5 rounded-full bg-yellow-500"></div>
                        <div class="w-2.5 h-2.5 rounded-full bg-green-500"></div>
                    </div>
                    <pre class="text-gray-300 text-xs p-4 pt-8 overflow-x-auto font-mono leading-relaxed max-h-[500px]">{{ json_encode($order->raw_payment_payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</pre>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection