{{-- FILE: resources/views/sysadmin/dashboard/course_admin_management/_form.blade.php --}}
<div class="mb-4">
    <label for="name" class="block mb-1 font-medium text-black">Nama</label>
    <input type="text" name="name" id="name" class="w-full border border-blue-100 px-3 py-2 rounded focus:outline-none focus:border-blue-500 @error('name') border-blue-500 @enderror" value="{{ old('name', $courseAdmin->name ?? '') }}" required>
    @error('name') <p class="text-gray-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label for="email" class="block mb-1 font-medium text-black">Email</label>
    <input type="email" name="email" id="email" class="w-full border border-blue-100 px-3 py-2 rounded focus:outline-none focus:border-blue-500 @error('email') border-blue-500 @enderror" value="{{ old('email', $courseAdmin->email ?? '') }}" required>
    @error('email') <p class="text-gray-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label for="password" class="block mb-1 font-medium text-black">Password @if(isset($edit)) (kosongkan jika tidak ingin mengganti) @endif</label>
    <input type="password" id="password" name="password" class="w-full border border-blue-100 px-3 py-2 rounded focus:outline-none focus:border-blue-500 @error('password') border-blue-500 @enderror">
    @error('password') <p class="text-gray-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label for="password_confirmation" class="block mb-1 font-medium text-black">Konfirmasi Password</label>
    <input type="password" id="password_confirmation" name="password_confirmation" class="w-full border border-blue-100 px-3 py-2 rounded focus:outline-none focus:border-blue-500">
</div>

<button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Simpan</button>
<a href="{{ route('sysadmin.manage_course_admin.index') }}" class="ml-2 text-gray-600 hover:text-black px-4 py-2">Batal</a>