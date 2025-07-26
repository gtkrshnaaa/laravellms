@csrf
<div class="mb-4">
    <label for="name" class="block mb-1 font-medium">Nama</label>
    <input type="text" name="name" id="name" class="w-full border px-3 py-2 rounded @error('name') border-gray-500 @enderror" value="{{ old('name', $student->name ?? '') }}" required>
    @error('name') <p class="text-gray-500 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label for="email" class="block mb-1 font-medium">Email</label>
    <input type="email" name="email" id="email" class="w-full border px-3 py-2 rounded @error('email') border-gray-500 @enderror" value="{{ old('email', $student->email ?? '') }}" required>
    @error('email') <p class="text-gray-500 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label for="password" class="block mb-1 font-medium">Password @if(isset($student)) (kosongkan jika tidak ingin mengganti) @endif</label>
    <input type="password" id="password" name="password" class="w-full border px-3 py-2 rounded @error('password') border-gray-500 @enderror" @if(!isset($student)) required @endif>
    @error('password') <p class="text-gray-500 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label for="password_confirmation" class="block mb-1 font-medium">Konfirmasi Password</label>
    <input type="password" id="password_confirmation" name="password_confirmation" class="w-full border px-3 py-2 rounded" @if(!isset($student)) required @endif>
</div>

<button type="submit" class="bg-black text-white px-4 py-2 rounded">Simpan</button>
<a href="{{ route('sysadmin.manage_student.index') }}" class="ml-2 bg-gray-300 text-gray-900 px-4 py-2 rounded">Batal</a>
