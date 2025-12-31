{{-- FILE: resources/views/course_admin/dashboard/course_management/topics/_form.blade.php --}}
<div class="space-y-6">
    {{-- Judul Topik --}}
    <div>
        <label for="title" class="block text-sm font-medium text-secondary mb-2">Judul Topik</label>
        <input type="text" name="title" id="title" 
            class="w-full bg-background border border-border rounded-lg px-4 py-2.5 text-primary placeholder-secondary/50 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors duration-200" 
            placeholder="Contoh: Pengenalan Dasar"
            value="{{ old('title', $topic->title ?? '') }}" required>
        @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    {{-- Urutan --}}
    <div>
        <label for="order" class="block text-sm font-medium text-secondary mb-2">Urutan</label>
        <input type="number" name="order" id="order" 
            class="w-full bg-background border border-border rounded-lg px-4 py-2.5 text-primary placeholder-secondary/50 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors duration-200" 
            placeholder="0"
            value="{{ old('order', $topic->order ?? '0') }}" required>
        <p class="text-xs text-secondary mt-1">Angka yang lebih kecil akan tampil lebih awal.</p>
        @error('order') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    {{-- Buttons --}}
    <div class="flex items-center gap-3 pt-6 border-t border-border">
        <button type="submit" class="px-6 py-2.5 bg-primary text-background font-medium rounded-lg hover:bg-primary/90 transition-colors focus:ring-2 focus:ring-primary focus:ring-offset-2">
            Simpan Topik
        </button>
        <a href="{{ route('course_admin.management.courses.show', $course) }}" class="px-6 py-2.5 bg-surface border border-border text-secondary font-medium rounded-lg hover:text-primary hover:border-primary transition-colors focus:ring-2 focus:ring-border">
            Batal
        </a>
    </div>
</div>
