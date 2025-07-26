<!DOCTYPE html>
<html lang="id" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Siswa - LMS Laravel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>body { font-family: 'Poppins', sans-serif; }</style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body class="h-full flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-gray-600">Buat Akun Baru</h1>
            <p class="text-gray-500 mt-1">Daftarkan diri Anda untuk mengakses kursus kami.</p>
        </div>
        <div class="bg-white p-8 rounded-lg border-2 border-gray-100">
            <form action="{{ route('student.register') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required class="mt-1 block w-full px-3 py-2 border @error('name') border-gray-500 @else border-gray-300 @enderror rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500">
                    @error('name') <p class="text-gray-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required class="mt-1 block w-full px-3 py-2 border @error('email') border-gray-500 @else border-gray-300 @enderror rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500">
                    @error('email') <p class="text-gray-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password" required class="mt-1 block w-full px-3 py-2 border @error('password') border-gray-500 @else border-gray-300 @enderror rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500">
                    @error('password') <p class="text-gray-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500">
                </div>
                <div>
                    <button type="submit" class="w-full mt-2 flex justify-center py-2 px-4 border border-transparent rounded-md font-bold text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Daftar
                    </button>
                </div>
            </form>
            <p class="text-center text-sm text-gray-500 mt-6">
                Sudah punya akun? <a href="{{ route('student.login') }}" class="font-medium text-gray-600 hover:text-gray-500">Login di sini</a>
            </p>
        </div>
    </div>
</body>
</html>