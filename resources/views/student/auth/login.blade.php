<!DOCTYPE html>
<html lang="id" class="h-full bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Siswa - LMS Laravel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>body { font-family: 'Poppins', sans-serif; }</style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body class="h-full flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-black">LMS Laravel</h1>
            <p class="text-black mt-1">Silakan login untuk memulai sesi belajar Anda.</p>
        </div>
        <div class="bg-white p-8 rounded-lg border border-blue-100">
            @if($errors->any())
                <div class="bg-blue-50 border-l-4 border-blue-500 text-black p-4 mb-6" role="alert">
                    <p>{{ $errors->first() }}</p>
                </div>
            @endif
            <form action="{{ route('student.login') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-black">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required class="mt-1 block w-full px-3 py-2 border border-blue-100 rounded-md focus:outline-none focus:border-blue-500">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-black">Password</label>
                    <input type="password" name="password" id="password" required class="mt-1 block w-full px-3 py-2 border border-blue-100 rounded-md focus:outline-none focus:border-blue-500">
                </div>
                <div>
                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-blue-600 rounded-md font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">
                        Login
                    </button>
                </div>
            </form>
            <p class="text-center text-sm text-black mt-6">
                Belum punya akun? <a href="{{ route('student.register') }}" class="font-medium text-blue-600 hover:text-blue-700">Daftar di sini</a>
            </p>
        </div>
    </div>
</body>
</html>