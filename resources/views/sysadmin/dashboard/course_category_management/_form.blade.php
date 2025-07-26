@csrf
<div class="mb-4">
    <label for="name" class="block mb-1 font-medium text-gray-700">Nama Kategori</label>
    <input type="text" name="name" id="name" class="w-full border-2 border-gray-200 px-3 py-2 rounded-md focus:outline-none focus:border-gray-500 @error('name') border-gray-500 @enderror" value="{{ old('name', $category->name ?? '') }}" required>
    @error('name') <p class="text-gray-500 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div class="flex items-center space-x-2">
    <button type="submit" class="bg-gray-800 hover:bg-gray-900 text-white font-bold py-2 px-4 rounded-md transition">Simpan</button>
    <a href="{{ route('sysadmin.manage-categories.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-md transition">Batal</a>
</div>