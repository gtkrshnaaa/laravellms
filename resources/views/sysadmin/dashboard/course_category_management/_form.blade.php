@csrf
<div class="space-y-6">
    <div>
        <label for="name" class="block text-sm font-medium text-secondary mb-2">Nama Kategori</label>
        <input type="text" name="name" id="name" 
            class="w-full bg-background border border-border rounded-lg px-4 py-2.5 text-primary placeholder-secondary/50 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors duration-200" 
            placeholder="Masukkan nama kategori (contoh: Pemrograman Web)"
            value="{{ old('name', $category->name ?? '') }}" required>
        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div class="flex items-center gap-3 pt-4 border-t border-border">
        <button type="submit" class="px-6 py-2.5 bg-primary text-background font-medium rounded-lg hover:bg-primary/90 transition-colors focus:ring-2 focus:ring-primary focus:ring-offset-2">
            Simpan Data
        </button>
        <a href="{{ route('sysadmin.manage-categories.index') }}" class="px-6 py-2.5 bg-surface border border-border text-secondary font-medium rounded-lg hover:text-primary hover:border-primary transition-colors focus:ring-2 focus:ring-border">
            Batal
        </a>
    </div>
</div>