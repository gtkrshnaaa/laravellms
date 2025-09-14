@csrf
<div class="mb-4">
    <label for="name" class="block mb-1 font-medium text-black">Nama Kategori</label>
    <input type="text" name="name" id="name" class="w-full border border-blue-100 px-3 py-2 rounded-md focus:outline-none focus:border-blue-500 @error('name') border-blue-500 @enderror" value="{{ old('name', $category->name ?? '') }}" required>
    @error('name') <p class="text-gray-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div class="flex items-center space-x-2">
    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md transition">Simpan</button>
    <a href="{{ route('sysadmin.manage-categories.index') }}" class="text-gray-600 hover:text-black font-bold py-2 px-4 transition">Batal</a>
</div>