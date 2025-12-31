@extends('layouts.admin')

@section('title', 'Service Orders')

@section('content')
<div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <h1 class="text-3xl md:text-4xl font-bold text-primary mb-2">Service Orders</h1>
        <p class="text-secondary">Manage all service orders from members</p>
    </div>
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.service.settings.index') }}" class="flex items-center gap-2 bg-surface border border-border text-primary font-bold py-2 px-4 rounded-lg hover:bg-background transition-colors group">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 group-hover:rotate-90 transition-transform">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.159.956c.03.183.136.347.288.435.438.253.848.568 1.218.917.152.126.353.16.536.088l.904-.363c.517-.207 1.107.037 1.306.54l.56 1.417c.196.495-.01 1.077-.492 1.353l-.841.48c-.168.096-.248.293-.207.48.067.436.067.886 0 1.322-.04.187.04.384.207.48l.841.48c.484.276.688.858.492 1.353l-.56 1.417c-.199.503-.789.747-1.306.54l-.904-.363c.183.072.384.038.536-.088.37-.349.78-.664 1.218-.917.152-.088.258-.252.288-.435l.159-.956zM12 15a3 3 0 100-6 3 3 0 000 6z" />
            </svg>
            Manage Quota
        </a>
    </div>
</div>

<!-- Filters -->
<div class="bg-surface border border-border rounded-xl p-6 mb-6">
    <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <!-- Search -->
        <div>
            <label class="block text-sm font-medium text-primary mb-2">Search</label>
            <input type="text" 
                   name="search" 
                   value="{{ request('search') }}"
                   placeholder="Order/Customer number..."
                   class="w-full bg-background border border-border text-primary rounded-lg px-4 py-2 focus:outline-none focus:border-primary text-sm">
        </div>

        <!-- Status Filter -->
        <div>
            <label class="block text-sm font-medium text-primary mb-2">Status</label>
            <select name="status" class="w-full bg-background border border-border text-primary rounded-lg px-4 py-2 focus:outline-none focus:border-primary text-sm">
                <option value="">All Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>

        <!-- Service Type Filter -->
        <div>
            <label class="block text-sm font-medium text-primary mb-2">Service Type</label>
            <select name="service_type_id" class="w-full bg-background border border-border text-primary rounded-lg px-4 py-2 focus:outline-none focus:border-primary text-sm">
                <option value="">All Services</option>
                @foreach($serviceTypes as $type)
                <option value="{{ $type->id }}" {{ request('service_type_id') == $type->id ? 'selected' : '' }}>
                    {{ $type->name }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Submit -->
        <div class="flex items-end">
            <button type="submit" class="w-full bg-primary text-background font-bold py-2 px-4 rounded-lg hover:opacity-90 transition-opacity text-sm">
                Apply Filters
            </button>
        </div>
    </form>
</div>

<!-- Orders Table -->
@if($orders->count() > 0)
<div class="bg-surface border border-border rounded-xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-background border-b border-border">
                <tr>
                    <th class="text-left px-6 py-4 text-xs font-semibold text-primary uppercase">Order Info</th>
                    <th class="text-left px-6 py-4 text-xs font-semibold text-primary uppercase">Customer</th>
                    <th class="text-left px-6 py-4 text-xs font-semibold text-primary uppercase">Package</th>
                    <th class="text-left px-6 py-4 text-xs font-semibold text-primary uppercase">Status</th>
                    <th class="text-left px-6 py-4 text-xs font-semibold text-primary uppercase">Payment</th>
                    <th class="text-left px-6 py-4 text-xs font-semibold text-primary uppercase">Date</th>
                    <th class="text-right px-6 py-4 text-xs font-semibold text-primary uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border">
                @foreach($orders as $order)
                <tr class="hover:bg-background/50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="font-mono text-sm font-bold text-primary">{{ $order->order_number }}</div>
                        <div class="font-mono text-xs text-secondary">{{ $order->customer_number }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-medium text-primary">{{ $order->buyer->username }}</div>
                        <div class="text-xs text-secondary">{{ $order->contact_phone }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-medium text-primary">{{ $order->servicePackage->name }}</div>
                        <div class="text-xs text-secondary">{{ $order->servicePackage->serviceType->name }}</div>
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
                        <span class="inline-block px-2 py-1 rounded-full text-xs font-bold border {{ $statusColors[$order->status] ?? '' }}">
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
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('admin.service.orders.show', $order) }}" 
                           class="inline-flex items-center gap-1 text-sm text-primary hover:underline">
                            Manage
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
    {{ $orders->appends(request()->query())->links() }}
</div>

@else
<div class="bg-surface border border-border rounded-xl p-12 text-center">
    <h3 class="text-xl font-bold text-primary mb-2">No orders found</h3>
    <p class="text-secondary">Try adjusting your filters or wait for new orders</p>
</div>
@endif
@endsection
