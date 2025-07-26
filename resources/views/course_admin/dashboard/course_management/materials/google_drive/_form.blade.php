@csrf
<div class="mb-4">
    <label for="title" class="block text-dark-text font-medium mb-2">Judul Materi</label>
    <input type="text" name="title" id="title" class="w-full border border-gray-300 px-3 py-2 rounded-md" value="{{ old('title', $googleDriveMaterial->title ?? '') }}" required>
</div>
<div class="mb-4">
    <label for="google_drive_url" class="block text-dark-text font-medium mb-2">URL Google Drive</label>
    <input type="url" name="google_drive_url" id="google_drive_url" class="w-full border border-gray-300 px-3 py-2 rounded-md" value="{{ old('google_drive_url', $googleDriveMaterial->google_drive_url ?? '') }}" required placeholder="https://docs.google.com/...">
    <small class="text-light-text">Pastikan link sudah di-set "anyone with the link can view".</small>
</div>
<div class="mb-4">
    <label for="description" class="block text-dark-text font-medium mb-2">Deskripsi (Opsional)</label>
    <textarea name="description" id="description" rows="3" class="w-full border border-gray-300 px-3 py-2 rounded-md">{{ old('description', $googleDriveMaterial->description ?? '') }}</textarea>
</div>
<div class="mb-6">
    <label for="order" class="block text-dark-text font-medium mb-2">Urutan</label>
    <input type="number" name="order" id="order" class="w-full border border-gray-300 px-3 py-2 rounded-md" value="{{ old('order', $googleDriveMaterial->order ?? '0') }}" required>
</div>
<div class="flex items-center">
    <button type="submit" class="bg-main-red hover:bg-dark-red text-white font-bold py-2 px-4 rounded-md">Simpan Materi</button>
    <a href="{{ route('course_admin.management.topics.materials', $topic) }}" class="ml-4 text-light-text hover:text-dark-text">Batal</a>
</div>