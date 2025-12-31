{{-- FILE: resources/views/course_admin/dashboard/course_management/materials/quizzes/_form.blade.php --}}
<div class="space-y-6">
    {{-- Judul Kuis --}}
    <div>
        <label for="title" class="block text-sm font-medium text-secondary mb-2">Judul Kuis</label>
        <input type="text" name="title" id="title" 
            class="w-full bg-background border border-border rounded-lg px-4 py-2.5 text-primary placeholder-secondary/50 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors duration-200" 
            placeholder="Contoh: Kuis Harian 1"
            value="{{ old('title', $quiz->title ?? '') }}" required>
        @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    {{-- Deskripsi --}}
    <div>
        <label for="description" class="block text-sm font-medium text-secondary mb-2">Deskripsi (Opsional)</label>
        <textarea name="description" id="description" rows="3" 
            class="w-full bg-background border border-border rounded-lg px-4 py-2.5 text-primary placeholder-secondary/50 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors duration-200"
            placeholder="Jelaskan mengenai kuis ini...">{{ old('description', $quiz->description ?? '') }}</textarea>
        @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Skor Minimum --}}
        <div>
            <label for="min_score" class="block text-sm font-medium text-secondary mb-2">Skor Minimum Lulus</label>
            <input type="number" name="min_score" id="min_score" 
                class="w-full bg-background border border-border rounded-lg px-4 py-2.5 text-primary placeholder-secondary/50 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors duration-200" 
                value="{{ old('min_score', $quiz->min_score ?? '70') }}" required min="0" max="100">
            @error('min_score') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Urutan --}}
        <div>
            <label for="order" class="block text-sm font-medium text-secondary mb-2">Urutan</label>
            <input type="number" name="order" id="order" 
                class="w-full bg-background border border-border rounded-lg px-4 py-2.5 text-primary placeholder-secondary/50 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors duration-200" 
                value="{{ old('order', $quiz->order ?? '0') }}" required>
            @error('order') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
    </div>

    {{-- Buttons --}}
    <div class="flex items-center gap-3 pt-6 border-t border-border">
        <button type="submit" class="px-6 py-2.5 bg-primary text-background font-medium rounded-lg hover:bg-primary/90 transition-colors focus:ring-2 focus:ring-primary focus:ring-offset-2">
            Simpan Kuis
        </button>
        <a href="{{ route('course_admin.management.courses.show', $course ?? $topic->course) }}" class="px-6 py-2.5 bg-surface border border-border text-secondary font-medium rounded-lg hover:text-primary hover:border-primary transition-colors focus:ring-2 focus:ring-border">
            Batal
        </a>
    </div>
</div>
