@extends('layouts.buyer')

@section('title', 'My Service Orders')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl md:text-4xl font-bold text-primary mb-2">My Service Orders</h1>
    <p class="text-secondary">Track semua order jasa kamu disini</p>
</div>

@if(session('success'))
<div class="mb-6 bg-green-900/30 border border-green-900 text-green-300 px-4 py-3 rounded-lg">
    {{ session('success') }}
</div>
@endif

@if($orders->count() > 0)
<div class="bg-surface border border-border rounded-xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-background border-b border-border">
                <tr>
                    <th class="text-left px-6 py-4 text-sm font-semibold text-primary">Order Info</th>
                    <th class="text-left px-6 py-4 text-sm font-semibold text-primary">Package</th>
                    <th class="text-left px-6 py-4 text-sm font-semibold text-primary">Status</th>
                    <th class="text-left px-6 py-4 text-sm font-semibold text-primary">Payment</th>
                    <th class="text-left px-6 py-4 text-sm font-semibold text-primary">Date</th>
                    <th class="text-right px-6 py-4 text-sm font-semibold text-primary">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border">
                @foreach($orders as $order)
                <tr class="hover:bg-background/50 transition-colors">
                    <td class="px-6 py-4">
                        <div>
                            <div class="font-mono text-sm font-bold text-primary">{{ $order->order_number }}</div>
                            <div class="font-mono text-xs text-secondary">{{ $order->customer_number }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div>
                            <div class="font-medium text-primary">{{ $order->servicePackage->name }}</div>
                            <div class="text-xs text-secondary">{{ $order->servicePackage->serviceType->name }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        @php
                            $statusColors = [
                                'pending' => 'bg-yellow-500/20 text-yellow-400 border-yellow-500/30',
                                'confirmed' => 'bg-blue-500/20 text-blue-400 border-blue-500/30',
                                'in_progress' => 'bg-purple-500/20 text-purple-400 border-purple-500/30',
                                'completed' => 'bg-green-500/20 text-green-400 border-green-500/30',
                                'cancelled' => 'bg-red-500/20 text-red-400 border-red-500/30',
                            ];
                        @endphp
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-bold border {{ $statusColors[$order->status] ?? '' }}">
                            {{ strtoupper(str_replace('_', ' ', $order->status)) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        @php
                            $paymentColors = [
                                'unpaid' => 'bg-red-500/20 text-red-400',
                                'paid' => 'bg-green-500/20 text-green-400',
                                'refunded' => 'bg-gray-500/20 text-gray-400',
                            ];
                        @endphp
                        <span class="inline-block px-2 py-1 rounded text-xs font-bold {{ $paymentColors[$order->payment_status] ?? '' }}">
                            {{ strtoupper($order->payment_status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-secondary">{{ $order->created_at->format('d M Y') }}</div>
                        <div class="text-xs text-secondary/70">{{ $order->created_at->diffForHumans() }}</div>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('buyer.service.orders.show', $order->order_number) }}" 
                           class="inline-flex items-center gap-1 text-sm text-primary hover:underline">
                            View Detail
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Pagination -->
<div class="mt-6">
    {{ $orders->links() }}
</div>

@else
<div class="bg-surface border border-border rounded-xl p-12 text-center">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 text-secondary mx-auto mb-4">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
    </svg>
    <h3 class="text-xl font-bold text-primary mb-2">Belum ada order</h3>
    <p class="text-secondary mb-6">Kamu belum pernah order layanan apapun</p>
    <a href="{{ route('home') }}" class="inline-block bg-primary text-background font-bold py-2 px-6 rounded-full hover:opacity-90 transition-opacity">
        Browse Layanan
    </a>
</div>
@endif
@endsection
