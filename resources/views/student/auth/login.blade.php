<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Siswa - LMS Laravel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        background: '#ffffff',
                        surface: '#ffffff',
                        border: '#e4e4e7',
                        primary: '#18181b',
                        secondary: '#71717a',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body class="font-sans text-primary flex items-center justify-center min-h-screen p-4 bg-gradient-to-br from-gray-50 to-gray-200 dark:from-gray-900 dark:to-black">
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    <div class="w-full max-w-md bg-white border border-gray-200 rounded-2xl shadow-sm p-8">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold tracking-tight mb-2">Selamat Datang Kembali</h1>
            <p class="text-secondary text-sm">Masuk untuk melanjutkan pembelajaran Anda.</p>
        </div>

        @if($errors->any())
            <div class="mb-6 p-4 rounded-lg bg-red-50 border border-red-200 text-red-600 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('student.login') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium mb-1.5">Email</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-secondary">
                        <i class="uil uil-envelope"></i>
                    </span>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required 
                        class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-gray-300 focus:border-black focus:ring-1 focus:ring-black outline-none transition-all placeholder-gray-400"
                        placeholder="nama@email.com">
                </div>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium mb-1.5">Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-secondary">
                        <i class="uil uil-padlock"></i>
                    </span>
                    <input type="password" name="password" id="password" required 
                        class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-gray-300 focus:border-black focus:ring-1 focus:ring-black outline-none transition-all placeholder-gray-400"
                        placeholder="••••••••">
                </div>
            </div>

            <button type="submit" class="w-full py-2.5 bg-black text-white font-semibold rounded-lg hover:bg-gray-800 transition-colors focus:ring-2 focus:ring-offset-2 focus:ring-gray-900">
                Masuk Sekarang
            </button>
        </form>

        <div class="mt-8 pt-6 border-t border-gray-100 text-center">
            <p class="text-sm text-secondary">
                Belum punya akun? 
                <a href="{{ route('student.register') }}" class="font-semibold text-black hover:underline">Daftar Gratis</a>
            </p>
        </div>
    </div>
</body>
</html>