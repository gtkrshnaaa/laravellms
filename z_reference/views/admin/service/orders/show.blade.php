@extends('layouts.admin')

@section('title', 'Order ' . $order->order_number)

@section('content')
<div class="max-w-6xl">
    <div class="mb-8">
        <a href="{{ route('admin.service.orders.index') }}" class="inline-flex items-center gap-2 text-secondary hover:text-primary transition-colors mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            Back to Orders
        </a>

        <div class="flex items-start justify-between">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold text-primary mb-2">{{ $order->order_number }}</h1>
                <p class="text-secondary font-mono">{{ $order->customer_number }}</p>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="mb-6 bg-green-900/30 border border-green-900 text-green-300 px-4 py-3 rounded-lg">
        {{ session('success') }}
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Order Info -->
            <div class="bg-surface border border-border rounded-xl p-6">
                <h2 class="text-xl font-bold text-primary mb-4">Order Information</h2>
                
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="text-sm text-secondary">Package</label>
                        <div class="text-primary font-medium">{{ $order->servicePackage->name }}</div>
                        <div class="text-xs text-secondary">{{ $order->servicePackage->serviceType->name }}</div>
                    </div>
                    <div>
                        <label class="text-sm text-secondary">Price</label>
                        @if($order->servicePackage->price)
                            <div class="text-primary font-medium">Rp {{ number_format($order->servicePackage->price, 0, ',', '.') }}</div>
                        @else
                            <div class="text-green-400 font-medium">GRATIS</div>
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm text-secondary">Customer</label>
                        <div class="text-primary font-medium">{{ $order->buyer->username }}</div>
                        <div class="text-xs text-secondary">{{ $order->buyer->email }}</div>
                    </div>
                    <div>
                        <label class="text-sm text-secondary">Order Date</label>
                        <div class="text-primary font-medium">{{ $order->created_at->format('d M Y, H:i') }}</div>
                    </div>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="bg-surface border border-border rounded-xl p-6">
                <h2 class="text-xl font-bold text-primary mb-4">Contact Information</h2>
                <div class="grid grid-cols-2 gap-4">
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
            <div class="bg-surface border border-border rounded-xl p-6">
                <h2 class="text-xl font-bold text-primary mb-4">Project Description</h2>
                <p class="text-secondary whitespace-pre-line">{{ $order->project_description }}</p>

                @if($order->additional_notes)
                <div class="mt-4 pt-4 border-t border-border">
                    <label class="text-sm font-semibold text-secondary">Additional Notes:</label>
                    <p class="text-secondary mt-1 whitespace-pre-line">{{ $order->additional_notes }}</p>
                </div>
                @endif
            </div>

            <!-- Admin Notes -->
            <div class="bg-surface border border-border rounded-xl p-6">
                <h2 class="text-xl font-bold text-primary mb-4">Admin Notes</h2>
                <form action="{{ route('admin.service.orders.notes', $order) }}" method="POST">
                    @csrf
                    <textarea name="admin_notes" 
                              rows="4"
                              placeholder="Add internal notes about this order..."
                              class="w-full bg-background border border-border text-primary rounded-lg px-4 py-3 focus:outline-none focus:border-primary resize-none mb-4">{{ $order->admin_notes }}</textarea>
                    <button type="submit" class="bg-primary text-background font-bold py-2 px-6 rounded-lg hover:opacity-90 transition-opacity text-sm">
                        Save Notes
                    </button>
                </form>
            </div>
        </div>

        <!-- Sidebar Actions -->
        <div class="space-y-6">
            <!-- Status Management -->
            <div class="bg-surface border border-border rounded-xl p-6">
                <h3 class="font-bold text-primary mb-4">Update Status</h3>
                <form action="{{ route('admin.service.orders.status', $order) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <select name="status" class="w-full bg-background border border-border text-primary rounded-lg px-4 py-2 focus:outline-none focus:border-primary mb-4">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="in_progress" {{ $order->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    <button type="submit" class="w-full bg-primary text-background font-bold py-2 px-4 rounded-lg hover:opacity-90 transition-opacity">
                        Update Status
                    </button>
                </form>
            </div>

            <!-- Payment Status -->
            <div class="bg-surface border border-border rounded-xl p-6">
                <h3 class="font-bold text-primary mb-4">Payment Status</h3>
                <form action="{{ route('admin.service.orders.payment', $order) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <select name="payment_status" class="w-full bg-background border border-border text-primary rounded-lg px-4 py-2 focus:outline-none focus:border-primary mb-4">
                        <option value="unpaid" {{ $order->payment_status == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                        <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="refunded" {{ $order->payment_status == 'refunded' ? 'selected' : '' }}>Refunded</option>
                    </select>
                    <button type="submit" class="w-full bg-primary text-background font-bold py-2 px-4 rounded-lg hover:opacity-90 transition-opacity">
                        Update Payment
                    </button>
                </form>
            </div>

            <!-- Timeline -->
            <div class="bg-surface border border-border rounded-xl p-6">
                <h3 class="font-bold text-primary mb-4">Timeline</h3>
                <div class="space-y-3 text-sm">
                    <div>
                        <div class="text-secondary">Created</div>
                        <div class="text-primary font-medium">{{ $order->created_at->format('d M Y, H:i') }}</div>
                    </div>
                    @if($order->started_at)
                    <div>
                        <div class="text-secondary">Started</div>
                        <div class="text-primary font-medium">{{ $order->started_at->format('d M Y, H:i') }}</div>
                    </div>
                    @endif
                    @if($order->completed_at)
                    <div>
                        <div class="text-secondary">Completed</div>
                        <div class="text-primary font-medium">{{ $order->completed_at->format('d M Y, H:i') }}</div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
