@extends('layouts.buyer')

@section('title', 'Order ' . $package->name)

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('services.show', $package->serviceType->slug) }}" class="inline-flex items-center gap-2 text-secondary hover:text-primary transition-colors mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            Back to {{ $package->serviceType->name }}
        </a>

        <h1 class="text-3xl md:text-4xl font-bold text-primary mb-2">Order: {{ $package->name }}</h1>
        <p class="text-secondary">{{ $package->serviceType->card_title }}</p>
    </div>

    <!-- Package Summary Card -->
    <div class="bg-surface border border-border rounded-xl p-6 mb-8">
        <div class="flex items-start justify-between mb-4">
            <div>
                <h2 class="text-xl font-bold text-primary mb-2">{{ $package->name }}</h2>
                <p class="text-secondary text-sm">{{ $package->description }}</p>
            </div>
            <div class="text-right">
                @if($package->price)
                    <div class="text-2xl font-bold text-primary">Rp {{ number_format($package->price, 0, ',', '.') }}</div>
                @else
                    <div class="text-2xl font-bold text-green-400">GRATIS</div>
                @endif
                @if($package->duration_days)
                    <p class="text-xs text-secondary mt-1">~{{ $package->duration_days }} hari</p>
                @endif
            </div>
        </div>

        @if($package->features && count($package->features) > 0)
        <div class="border-t border-border pt-4">
            <h3 class="font-semibold text-primary text-sm mb-2">Included:</h3>
            <div class="grid grid-cols-2 gap-2">
                @foreach($package->features as $feature)
                <div class="flex items-start gap-2 text-sm text-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-green-400 flex-shrink-0 mt-0.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                    <span>{{ $feature }}</span>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <!-- Order Form -->
    <form action="{{ route('buyer.service.order.store') }}" method="POST" class="bg-surface border border-border rounded-xl p-6">
        @csrf
        <input type="hidden" name="service_package_id" value="{{ $package->id }}">

        <h2 class="text-xl font-bold text-primary mb-6">Detail Order</h2>

        @if($errors->any())
        <div class="mb-6 bg-red-900/30 border border-red-900 text-red-300 px-4 py-3 rounded-lg text-sm">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Contact Phone -->
        <div class="mb-6">
            <label for="contact_phone" class="block text-sm font-medium text-primary mb-2">
                Nomor WhatsApp <span class="text-red-500">*</span>
            </label>
            <input type="text" 
                   name="contact_phone" 
                   id="contact_phone" 
                   value="{{ old('contact_phone', $buyer->phone) }}"
                   placeholder="08123456789"
                   class="w-full bg-background border border-border text-primary rounded-lg px-4 py-3 focus:outline-none focus:border-primary transition-colors"
                   required>
            <p class="text-xs text-secondary mt-1">Kami akan menghubungi kamu via WhatsApp</p>
        </div>

        <!-- Contact Email -->
        <div class="mb-6">
            <label for="contact_email" class="block text-sm font-medium text-primary mb-2">
                Email <span class="text-red-500">*</span>
            </label>
            <input type="email" 
                   name="contact_email" 
                   id="contact_email" 
                   value="{{ old('contact_email', $buyer->email) }}"
                   placeholder="your@email.com"
                   class="w-full bg-background border border-border text-primary rounded-lg px-4 py-3 focus:outline-none focus:border-primary transition-colors"
                   required>
        </div>

        <!-- Project Description -->
        <div class="mb-6">
            <label for="project_description" class="block text-sm font-medium text-primary mb-2">
                Deskripsi Project <span class="text-red-500">*</span>
            </label>
            <textarea name="project_description" 
                      id="project_description" 
                      rows="6"
                      placeholder="Jelaskan kebutuhan project kamu secara detail... (minimal 50 karakter)"
                      class="w-full bg-background border border-border text-primary rounded-lg px-4 py-3 focus:outline-none focus:border-primary transition-colors resize-none"
                      required>{{ old('project_description') }}</textarea>
            <p class="text-xs text-secondary mt-1">Semakin detail, semakin baik kami bisa memahami kebutuhan kamu</p>
        </div>

        <!-- Additional Notes -->
        <div class="mb-8">
            <label for="additional_notes" class="block text-sm font-medium text-primary mb-2">
                Catatan Tambahan <span class="text-secondary">(opsional)</span>
            </label>
            <textarea name="additional_notes" 
                      id="additional_notes" 
                      rows="3"
                      placeholder="Ada catatan khusus? Tulis disini..."
                      class="w-full bg-background border border-border text-primary rounded-lg px-4 py-3 focus:outline-none focus:border-primary transition-colors resize-none">{{ old('additional_notes') }}</textarea>
        </div>

        <!-- Important Notice -->
        <div class="bg-primary/5 border border-primary/20 rounded-lg p-4 mb-6">
            <h3 class="font-semibold text-primary text-sm mb-2">⚠️ Penting!</h3>
            <ul class="text-xs text-secondary space-y-1">
                <li>• Setelah submit, kami akan review order kamu dalam 1x24 jam</li>
                <li>• Kamu akan mendapat <strong>Order Number</strong> dan <strong>Customer Number</strong></li>
                <li>• Kami akan hubungi kamu via WA untuk konfirmasi detail & pembayaran</li>
                <li>• Pembayaran dilakukan diluar platform (transfer bank)</li>
            </ul>
        </div>

        <!-- Submit Button -->
        <div class="flex gap-4">
            <button type="submit" 
                    class="flex-1 bg-primary text-background font-bold py-3 px-6 rounded-full hover:opacity-90 transition-opacity">
                Submit Order
            </button>
            <a href="{{ route('services.show', $package->serviceType->slug) }}" 
               class="px-6 py-3 border border-border text-secondary hover:text-primary hover:border-primary rounded-full transition-colors">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
