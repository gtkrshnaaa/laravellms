{{-- FILE: resources/views/course_admin/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Course Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- Custom Tailwind CSS Configuration for Red Theme --}}
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'main-red': '#DC2626', // Tailwind's gray-600
                        'light-red': '#FEE2E2', // Tailwind's gray-100 for very light accents
                        'dark-red': '#991B1B', // Tailwind's gray-800 for deeper accents
                        'light-gray-cream': '#F8F8F8', // Off-white/cream for soft backgrounds
                        'dark-text': '#333333', // Soft dark for text
                        'light-text': '#6B7280', // Lighter text for descriptions
                    },
                }
            }
        }
    </script>
    {{-- Google Fonts - Quicksand for a soft, modern feel --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;700&display=swap" rel="stylesheet">
    {{-- Unicons CSS --}}
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <style>
        body {
            font-family: 'Quicksand', sans-serif;
        }
    </style>
</head>
<body class="h-full flex items-center justify-center">
    <div class="w-full max-w-md bg-white rounded-lg shadow-xl p-8 border border-light-red">
        {{-- Unicons User icon above the title --}}
        <div class="flex justify-center mb-4">
            <i class="uil uil-user-circle text-main-red text-6xl"></i> {{-- Ukuran ikon lebih besar --}}
        </div>
        <h1 class="text-3xl font-bold mb-8 text-center text-dark-text">Course Admin Login</h1>
        @if($errors->any())
            <div class="mb-6 bg-gray-100 border-l-4 border-gray-500 text-gray-700 px-4 py-3 rounded-md">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('course_admin.login.post') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="email" class="block mb-2 font-medium text-dark-text">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-main-red focus:border-transparent @error('email') border-gray-500 @enderror"/>
                @error('email') <p class="text-gray-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="password" class="block mb-2 font-medium text-dark-text">Password</label>
                <input id="password" name="password" type="password" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-main-red focus:border-transparent @error('password') border-gray-500 @enderror" />
                @error('password') <p class="text-gray-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            {{-- Checkbox "Tampilkan Password" --}}
            <div class="flex items-center">
                <input type="checkbox" id="show_password" onclick="togglePasswordVisibility()" class="h-4 w-4 text-main-red focus:ring-main-red border-gray-300 rounded">
                <label for="show_password" class="ml-2 block text-sm text-dark-text">Tampilkan password</label>
            </div>
            <button type="submit" class="w-full bg-main-red text-white py-2 rounded-md font-semibold hover:bg-dark-red transition duration-300">
                Login
            </button>
        </form>
    </div>

    {{-- Script untuk toggle password --}}
    <script>
        function togglePasswordVisibility() {
            const passwordField = document.getElementById('password');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        }
    </script>
</body>
</html>