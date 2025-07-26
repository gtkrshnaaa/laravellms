<!DOCTYPE html>
<html lang="id" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Dosen - LMS Laravel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>body { font-family: 'Poppins', sans-serif; }</style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body class="h-full flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-gray-600">Lecturer Area</h1>
            <p class="text-gray-500 mt-1">Silakan login untuk mengakses panel dosen.</p>
        </div>
        <div class="bg-white p-8 rounded-lg border-2 border-gray-100">
            @if($errors->any())
                <div class="bg-gray-100 border-l-4 border-gray-500 text-gray-700 p-4 mb-6" role="alert">
                    <p>{{ $errors->first() }}</p>
                </div>
            @endif
            <form action="{{ route('lecturer.login.post') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <div class="relative">
                        <input type="password" name="password" id="password" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <span class="cursor-pointer" onclick="togglePasswordVisibility()">
                                <i id="password-toggle-icon" class="uil uil-eye text-gray-500"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div>
                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md font-bold text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('password-toggle-icon');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('uil-eye');
            toggleIcon.classList.add('uil-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('uil-eye-slash');
            toggleIcon.classList.add('uil-eye');
        }
    }
</script>
</html>