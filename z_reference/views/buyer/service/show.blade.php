@extends('layouts.buyer')

@section('title', 'Order ' . $order->order_number)

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('buyer.service.orders.index') }}" class="inline-flex items-center gap-2 text-secondary hover:text-primary transition-colors mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            Back to My Orders
        </a>

        <div class="flex items-start justify-between">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold text-primary mb-2">{{ $order->order_number }}</h1>
                <p class="text-secondary font-mono">Customer: {{ $order->customer_number }}</p>
            </div>
            @php
                $statusColors = [
                    'pending' => 'bg-yellow-500/20 text-yellow-400 border-yellow-500/30',
                    'confirmed' => 'bg-blue-500/20 text-blue-400 border-blue-500/30',
                    'in_progress' => 'bg-purple-500/20 text-purple-400 border-purple-500/30',
                    'completed' => 'bg-green-500/20 text-green-400 border-green-500/30',
                    'cancelled' => 'bg-red-500/20 text-red-400 border-red-500/30',
                ];
            @endphp
            <span class="inline-block px-4 py-2 rounded-full text-sm font-bold border {{ $statusColors[$order->status] ?? '' }}">
                {{ strtoupper(str_replace('_', ' ', $order->status)) }}
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Package Info -->
        <div class="bg-surface border border-border rounded-xl p-6">
            <h3 class="text-sm font-semibold text-secondary mb-2">Package</h3>
            <div class="text-lg font-bold text-primary">{{ $order->servicePackage->name }}</div>
            <div class="text-sm text-secondary">{{ $order->servicePackage->serviceType->name }}</div>
        </div>

        <!-- Payment Status -->
        <div class="bg-surface border border-border rounded-xl p-6">
            <h3 class="text-sm font-semibold text-secondary mb-2">Payment Status</h3>
            @php
                $paymentColors = [
                    'unpaid' => 'text-red-400',
                    'paid' => 'text-green-400',
                    'refunded' => 'text-gray-400',
                ];
            @endphp
            <div class="text-lg font-bold {{ $paymentColors[$order->payment_status] ?? '' }}">
                {{ strtoupper($order->payment_status) }}
            </div>
        </div>

        <!-- Order Date -->
        <div class="bg-surface border border-border rounded-xl p-6">
            <h3 class="text-sm font-semibold text-secondary mb-2">Order Date</h3>
            <div class="text-lg font-bold text-primary">{{ $order->created_at->format('d M Y') }}</div>
            <div class="text-sm text-secondary">{{ $order->created_at->diffForHumans() }}</div>
        </div>
    </div>

    <!-- Contact Information -->
    <div class="bg-surface border border-border rounded-xl p-6 mb-6">
        <h2 class="text-xl font-bold text-primary mb-4">Contact Information</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="text-sm text-secondary">WhatsApp</label>
                <div class="text-primary font-medium">{{ $order->contact_phone }}</div>
            </div>
            <div>
                <label class="text-sm text-secondary">Email</label>
                <div class="text-primary font-medium">{{ $order->contact_email }}</div>
            </div>
        </div>
    </div>

    <!-- Project Description -->
    <div class="bg-surface border border-border rounded-xl p-6 mb-6">
        <h2 class="text-xl font-bold text-primary mb-4">Project Description</h2>
        <p class="text-secondary whitespace-pre-line">{{ $order->project_description }}</p>

        @if($order->additional_notes)
        <div class="mt-4 pt-4 border-t border-border">
            <label class="text-sm font-semibold text-secondary">Additional Notes:</label>
            <p class="text-secondary mt-1 whitespace-pre-line">{{ $order->additional_notes }}</p>
        </div>
        @endif
    </div>

    <!-- Admin Notes (if any) -->
    @if($order->admin_notes)
    <div class="bg-primary/5 border border-primary/20 rounded-xl p-6 mb-6">
        <h2 class="text-xl font-bold text-primary mb-4">📝 Admin Notes</h2>
        <p class="text-secondary whitespace-pre-line">{{ $order->admin_notes }}</p>
    </div>
    @endif

    <!-- Timeline -->
    <div class="bg-surface border border-border rounded-xl p-6">
        <h2 class="text-xl font-bold text-primary mb-4">Order Timeline</h2>
        <div class="space-y-4">
            <div class="flex gap-4">
                <div class="flex flex-col items-center">
                    <div class="w-3 h-3 rounded-full bg-green-400"></div>
                    <div class="flex-1 w-0.5 bg-border mt-2"></div>
                </div>
                <div class="pb-8">
                    <div class="font-semibold text-primary">Order Created</div>
                    <div class="text-sm text-secondary">{{ $order->created_at->format('d M Y, H:i') }}</div>
                </div>
            </div>

            @if($order->started_at)
            <div class="flex gap-4">
                <div class="flex flex-col items-center">
                    <div class="w-3 h-3 rounded-full bg-purple-400"></div>
                    <div class="flex-1 w-0.5 bg-border mt-2"></div>
                </div>
                <div class="pb-8">
                    <div class="font-semibold text-primary">Work Started</div>
                    <div class="text-sm text-secondary">{{ $order->started_at->format('d M Y, H:i') }}</div>
                </div>
            </div>
            @endif

            @if($order->completed_at)
            <div class="flex gap-4">
                <div class="flex flex-col items-center">
                    <div class="w-3 h-3 rounded-full bg-green-400"></div>
                </div>
                <div>
                    <div class="font-semibold text-primary">Completed</div>
                    <div class="text-sm text-secondary">{{ $order->completed_at->format('d M Y, H:i') }}</div>
                </div>
            </div>
            @endif

            @if($order->status === 'pending')
            <div class="flex gap-4">
                <div class="flex flex-col items-center">
                    <div class="w-3 h-3 rounded-full bg-secondary/30"></div>
                </div>
                <div>
                    <div class="font-semibold text-secondary">Waiting for confirmation...</div>
                    <div class="text-sm text-secondary/70">We'll contact you soon</div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
