{{-- FILE: resources/views/course_admin/dashboard/course_management/materials/google_drive/_form.blade.php --}}
@csrf
<div class="space-y-6">
    {{-- Judul Materi --}}
    <div>
        <label for="title" class="block text-sm font-medium text-secondary mb-2">Judul Materi</label>
        <input type="text" name="title" id="title" 
            class="w-full bg-background border border-border rounded-lg px-4 py-2.5 text-primary placeholder-secondary/50 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors duration-200" 
            placeholder="Contoh: Modul Pembelajaran PDF"
            value="{{ old('title', $googleDriveMaterial->title ?? '') }}" required>
    </div>

    {{-- URL --}}
    <div>
        <label for="google_drive_url" class="block text-sm font-medium text-secondary mb-2">URL Google Drive (PDF/Doc/Sheet)</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-blue-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-1.07 3.97-2.9 5.4z"/></svg>
            </div>
            <input type="url" name="google_drive_url" id="google_drive_url" 
                class="w-full bg-background border border-border rounded-lg pl-10 pr-4 py-2.5 text-primary placeholder-secondary/50 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors duration-200" 
                placeholder="https://docs.google.com/..."
                value="{{ old('google_drive_url', $googleDriveMaterial->google_drive_url ?? '') }}" required>
        </div>
        <p class="text-xs text-secondary mt-1">Pastikan link sudah di-set "Anyone with the link can view".</p>
    </div>

    {{-- Deskripsi --}}
    <div>
        <label for="description" class="block text-sm font-medium text-secondary mb-2">Deskripsi (Opsional)</label>
        <textarea name="description" id="description" rows="3" 
            class="w-full bg-background border border-border rounded-lg px-4 py-2.5 text-primary placeholder-secondary/50 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors duration-200"
            placeholder="Deskripsi singkat tentang materi ini...">{{ old('description', $googleDriveMaterial->description ?? '') }}</textarea>
    </div>

    {{-- Urutan --}}
    <div>
        <label for="order" class="block text-sm font-medium text-secondary mb-2">Urutan</label>
        <input type="number" name="order" id="order" 
            class="w-full bg-background border border-border rounded-lg px-4 py-2.5 text-primary placeholder-secondary/50 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors duration-200" 
            value="{{ old('order', $googleDriveMaterial->order ?? '0') }}" required>
    </div>

    {{-- Buttons --}}
    <div class="flex items-center gap-3 pt-6 border-t border-border">
        <button type="submit" class="px-6 py-2.5 bg-primary text-background font-medium rounded-lg hover:bg-primary/90 transition-colors focus:ring-2 focus:ring-primary focus:ring-offset-2">
            Simpan Materi
        </button>
        <a href="{{ route('course_admin.management.topics.materials', $topic) }}" class="px-6 py-2.5 bg-surface border border-border text-secondary font-medium rounded-lg hover:text-primary hover:border-primary transition-colors focus:ring-2 focus:ring-border">
            Batal
        </a>
    </div>
</div>