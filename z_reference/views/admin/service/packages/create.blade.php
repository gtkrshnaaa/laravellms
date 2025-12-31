@extends('layouts.admin')

@section('title', 'Tambah Paket Layanan')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <!-- Header -->
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.service.packages.index') }}" class="p-2 text-secondary hover:text-primary hover:bg-surface rounded-lg transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
        </a>
        <div>
            <h2 class="text-2xl font-bold text-primary">Tambah Paket</h2>
            <p class="text-sm text-secondary">Buat paket baru untuk layanan.</p>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.service.packages.store') }}" method="POST" class="bg-surface border border-border rounded-xl p-6 space-y-6" x-data="{ 
        features: [''], 
        addFeature() { this.features.push('') }, 
        removeFeature(index) { this.features.splice(index, 1) } 
    }">
        @csrf

        <!-- Service Type Selection -->
        <div>
            <label for="service_type_id" class="block text-sm font-medium text-secondary mb-2">Jenis Layanan</label>
            <select name="service_type_id" id="service_type_id" class="w-full bg-background border border-border rounded-lg px-4 py-2 text-primary focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-colors" required>
                <option value="">Pilih Jenis Layanan</option>
                @foreach($serviceTypes as $type)
                    <option value="{{ $type->id }}" {{ (old('service_type_id') == $type->id || (request()->has('service_type_slug') && $type->slug == request()->service_type_slug)) ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
            @error('service_type_id')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Package Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-secondary mb-2">Nama Paket</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="w-full bg-background border border-border rounded-lg px-4 py-2 text-primary focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-colors" placeholder="Contoh: Paket Basic" required>
            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-sm font-medium text-secondary mb-2">Deskripsi</label>
            <textarea name="description" id="description" rows="3" class="w-full bg-background border border-border rounded-lg px-4 py-2 text-primary focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-colors" placeholder="Jelaskan detail paket ini..." required>{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Price & Duration -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="price" class="block text-sm font-medium text-secondary mb-2">Harga (Rp)</label>
                <input type="number" name="price" id="price" value="{{ old('price') }}" class="w-full bg-background border border-border rounded-lg px-4 py-2 text-primary focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-colors" placeholder="0 untuk Gratis">
                <p class="text-xs text-secondary mt-1">Kosongkan atau isi 0 jika gratis.</p>
                @error('price')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="duration_days" class="block text-sm font-medium text-secondary mb-2">Estimasi Durasi (Hari)</label>
                <input type="number" name="duration_days" id="duration_days" value="{{ old('duration_days') }}" class="w-full bg-background border border-border rounded-lg px-4 py-2 text-primary focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-colors" required>
                @error('duration_days')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Features (Dynamic List) -->
        <div>
            <label class="block text-sm font-medium text-secondary mb-2">Fitur Paket</label>
            <div class="space-y-3">
                <template x-for="(feature, index) in features" :key="index">
                    <div class="flex gap-2">
                        <input type="text" :name="'features[]'" x-model="features[index]" class="flex-1 bg-background border border-border rounded-lg px-4 py-2 text-primary focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-colors" placeholder="Contoh: Responsive Design" required>
                        <button type="button" @click="removeFeature(index)" class="p-2 text-red-500 hover:bg-red-500/10 rounded-lg transition-colors" x-show="features.length > 1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </template>
                <button type="button" @click="addFeature()" class="text-sm text-primary font-medium hover:underline flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Tambah Fitur
                </button>
            </div>
        </div>

        <!-- Settings -->
        <div class="space-y-4 pt-4 border-t border-border">
            <div class="flex items-center gap-3">
                <input type="checkbox" name="includes_hosting" id="includes_hosting" value="1" {{ old('includes_hosting') ? 'checked' : '' }} class="w-4 h-4 rounded border-border text-primary focus:ring-offset-background focus:ring-primary/20">
                <label for="includes_hosting" class="text-sm text-primary">Termasuk Hosting?</label>
            </div>
            <div class="flex items-center gap-3">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="w-4 h-4 rounded border-border text-primary focus:ring-offset-background focus:ring-primary/20">
                <label for="is_active" class="text-sm text-primary">Aktifkan Paket?</label>
            </div>
        </div>

        <!-- Display Order -->
        <div>
            <label for="display_order" class="block text-sm font-medium text-secondary mb-2">Urutan Tampilan</label>
            <input type="number" name="display_order" id="display_order" value="{{ old('display_order', 0) }}" class="w-32 bg-background border border-border rounded-lg px-4 py-2 text-primary focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-colors">
        </div>

        <!-- Submit -->
        <div class="flex justify-end pt-6 border-t border-border">
            <button type="submit" class="bg-primary text-background px-6 py-2.5 rounded-xl font-bold hover:opacity-90 transition-opacity shadow-lg shadow-primary/20">
                Simpan Paket
            </button>
        </div>
    </form>
</div>
@endsection
