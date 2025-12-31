{{-- FILE: resources/views/course_admin/dashboard/course_management/materials/videos/_form.blade.php --}}
<div class="space-y-6">
    {{-- Judul Video --}}
    <div>
        <label for="title" class="block text-sm font-medium text-secondary mb-2">Judul Video</label>
        <input type="text" name="title" id="title" 
            class="w-full bg-background border border-border rounded-lg px-4 py-2.5 text-primary placeholder-secondary/50 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors duration-200" 
            placeholder="Contoh: Pengantar Algoritma"
            value="{{ old('title', $video->title ?? '') }}" required>
        @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    {{-- YouTube URL --}}
    <div>
        <label for="youtube_url" class="block text-sm font-medium text-secondary mb-2">URL YouTube</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
            </div>
            <input type="url" name="youtube_url" id="youtube_url" 
                class="w-full bg-background border border-border rounded-lg pl-10 pr-4 py-2.5 text-primary placeholder-secondary/50 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors duration-200" 
                placeholder="https://www.youtube.com/watch?v=..."
                value="{{ old('youtube_url', $video->youtube_url ?? '') }}" required>
        </div>
        <p class="text-xs text-secondary mt-1">Masukkan URL video YouTube yang valid.</p>
        @error('youtube_url') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    {{-- Urutan --}}
    <div>
        <label for="order" class="block text-sm font-medium text-secondary mb-2">Urutan</label>
        <input type="number" name="order" id="order" 
            class="w-full bg-background border border-border rounded-lg px-4 py-2.5 text-primary placeholder-secondary/50 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors duration-200" 
            placeholder="0"
            value="{{ old('order', $video->order ?? '0') }}" required>
        <p class="text-xs text-secondary mt-1">Urutan tampilan materi dalam topik.</p>
        @error('order') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    {{-- Buttons --}}
    <div class="flex items-center gap-3 pt-6 border-t border-border">
        <button type="submit" class="px-6 py-2.5 bg-primary text-background font-medium rounded-lg hover:bg-primary/90 transition-colors focus:ring-2 focus:ring-primary focus:ring-offset-2">
            Simpan Video
        </button>
        <a href="{{ route('course_admin.management.courses.show', $course ?? $topic->course) }}" class="px-6 py-2.5 bg-surface border border-border text-secondary font-medium rounded-lg hover:text-primary hover:border-primary transition-colors focus:ring-2 focus:ring-border">
            Batal
        </a>
    </div>
</div>
