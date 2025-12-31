{{-- FILE: resources/views/course_admin/dashboard/course_management/_form.blade.php --}}
<div class="space-y-6">
    {{-- Nama Kursus --}}
    <div>
        <label for="name" class="block text-sm font-medium text-secondary mb-2">Nama Kursus</label>
        <input type="text" name="name" id="name" 
            class="w-full bg-background border border-border rounded-lg px-4 py-2.5 text-primary placeholder-secondary/50 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors duration-200" 
            placeholder="Masukkan nama kursus menarik Anda"
            value="{{ old('name', $course->name ?? '') }}" required>
        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    {{-- Kategori (Optional) --}}
    <div>
        <label for="course_sub_category_id" class="block text-sm font-medium text-secondary mb-2">Kategori Kursus (Opsional)</label>
        <div class="relative">
            <select name="course_sub_category_id" id="course_sub_category_id" 
                class="w-full bg-background border border-border rounded-lg px-4 py-2.5 text-primary focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors duration-200 appearance-none">
                <option value="">-- Pilih Kategori --</option>
                @foreach ($categories as $category)
                    <optgroup label="{{ $category->name }}">
                        @foreach ($category->subCategories as $subCategory)
                            <option value="{{ $subCategory->id }}" {{ old('course_sub_category_id', $course->course_sub_category_id ?? '') == $subCategory->id ? 'selected' : '' }}>
                                {{ $subCategory->name }}
                            </option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-secondary">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </div>
        </div>
        <p class="text-xs text-secondary mt-1">Mengelompokkan kursus membantu siswa menemukannya lebih mudah.</p>
        @error('course_sub_category_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    {{-- Thumbnail --}}
    <div>
        <label for="thumbnail" class="block text-sm font-medium text-secondary mb-2">Thumbnail Kursus</label>
        
        @if(isset($course) && $course->thumbnail)
            <div class="mb-3 relative group w-fit">
                <img src="{{ Storage::url($course->thumbnail) }}" alt="{{ $course->name }}" class="h-32 w-48 object-cover rounded-lg border border-border">
                <div class="absolute inset-0 bg-black/50 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs">
                    Gambar Saat Ini
                </div>
            </div>
        @endif

        <div class="flex items-center justify-center w-full">
            <label for="thumbnail" class="flex flex-col items-center justify-center w-full h-32 border-2 border-border border-dashed rounded-lg cursor-pointer bg-background hover:bg-slate-50 transition-colors">
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    <svg class="w-8 h-8 mb-3 text-secondary/70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                    <p class="mb-2 text-sm text-secondary"><span class="font-semibold text-primary">Klik untuk upload</span> atau drag and drop</p>
                    <p class="text-xs text-secondary/70">PNG, JPG or JPEG (Max. 2MB)</p>
                </div>
                <input id="thumbnail" name="thumbnail" type="file" class="hidden" accept="image/*" />
            </label>
        </div>
        @error('thumbnail') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    {{-- Deskripsi --}}
    <div>
        <label for="description" class="block text-sm font-medium text-secondary mb-2">Deskripsi Lengkap</label>
        <textarea name="description" id="description" rows="5" 
            class="w-full bg-background border border-border rounded-lg px-4 py-2.5 text-primary placeholder-secondary/50 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors duration-200" 
            placeholder="Jelaskan apa yang akan dipelajari siswa dalam kursus ini..."
            required>{{ old('description', $course->description ?? '') }}</textarea>
        @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    {{-- Buttons --}}
    <div class="flex items-center gap-3 pt-6 border-t border-border">
        <button type="submit" class="px-6 py-2.5 bg-primary text-background font-medium rounded-lg hover:bg-primary/90 transition-colors focus:ring-2 focus:ring-primary focus:ring-offset-2">
            Simpan Kursus
        </button>
        <a href="{{ route('course_admin.management.courses.index') }}" class="px-6 py-2.5 bg-surface border border-border text-secondary font-medium rounded-lg hover:text-primary hover:border-primary transition-colors focus:ring-2 focus:ring-border">
            Batal
        </a>
    </div>
</div>
