@extends('layouts.sysadmin')
@section('title', 'Detail Transaksi')

@section('content')
    <a href="{{ route('sysadmin.transactions.index') }}" class="text-sm text-gray-600 hover:underline mb-4 inline-block">
        <i class="uil uil-arrow-left"></i> Kembali ke Monitoring
    </a>
    <h1 class="text-2xl font-bold mb-1">Detail Transaksi</h1>
    <p class="font-mono text-sm text-gray-500 mb-6">{{ $order->id }}</p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="md:col-span-1 space-y-4">
            <div class="bg-white p-4 rounded-lg border-2 border-gray-100">
                <h3 class="font-bold mb-2">Informasi Order</h3>
                <p><strong>Siswa:</strong> {{ $order->student->name }}</p>
                <p><strong>Kursus:</strong> {{ $order->course->name }}</p>
                <p><strong>Jumlah:</strong> Rp{{ number_format($order->amount, 0, ',', '.') }}</p>
                <p><strong>Tanggal:</strong> {{ $order->created_at->format('d M Y, H:i:s') }}</p>
                <p><strong>Status:</strong> <span class="font-bold uppercase">{{ $order->status }}</span></p>
            </div>
             <div class="bg-white p-4 rounded-lg border-2 border-gray-100">
                <h3 class="font-bold mb-2">Aksi</h3>
                 @if($order->status == 'pending')
                    <form action="{{ route('sysadmin.transactions.sync', $order) }}" method="POST" class="inline" onsubmit="return confirm('Anda yakin ingin menyinkronkan status transaksi ini dengan Midtrans?')">
                        @csrf
                        <button type="submit" class="w-full bg-purple-600 text-white px-4 py-2 rounded-md hover:bg-purple-700">Sinkronkan Status Manual</button>
                    </form>
                 @else
                    <p class="text-sm text-gray-500">Tidak ada aksi yang tersedia untuk status '{{ $order->status }}'.</p>
                 @endif
            </div>
        </div>
        <div class="md:col-span-2">
             <div class="bg-white p-4 rounded-lg border-2 border-gray-100">
                <h3 class="font-bold mb-2">Raw Payment Payload (dari Midtrans)</h3>
                <pre class="bg-gray-800 text-white text-sm p-4 rounded-md overflow-auto max-h-96"><code>{{ json_encode($order->raw_payment_payload, JSON_PRETTY_PRINT) }}</code></pre>
            </div>
        </div>
    </div>
@endsection