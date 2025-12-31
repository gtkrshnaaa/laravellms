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
<body class="font-sans text-primary flex items-center justify-center min-h-screen p-4 bg-gradient-to-br from-gray-50 to-gray-200 dark:from-black dark:to-gray-900">
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    <div class="w-full max-w-md bg-surface border border-border rounded-2xl shadow-xl p-8 relative overflow-hidden">
        {{-- Gradient Glow --}}
        <div class="absolute top-0 right-0 w-64 h-64 bg-primary/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 pointer-events-none"></div>

        <div class="text-center mb-8 relative z-10">
            <h1 class="text-2xl font-bold tracking-tight mb-2 text-primary">Selamat Datang Kembali</h1>
            <p class="text-secondary text-sm">Masuk untuk melanjutkan pembelajaran Anda.</p>
        </div>

        @if($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-600 dark:text-red-400 text-sm relative z-10">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('student.login') }}" method="POST" class="space-y-5 relative z-10">
            @csrf
            <div>
                <label for="email" class="block text-sm font-bold text-primary mb-1.5">Email</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-secondary">
                        <i class="uil uil-envelope"></i>
                    </span>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required 
                        class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-background border border-border text-primary focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder-secondary"
                        placeholder="nama@email.com">
                </div>
            </div>

            <div>
                <label for="password" class="block text-sm font-bold text-primary mb-1.5">Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-secondary">
                        <i class="uil uil-padlock"></i>
                    </span>
                    <input type="password" name="password" id="password" required 
                        class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-background border border-border text-primary focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder-secondary"
                        placeholder="••••••••">
                </div>
            </div>

            <button type="submit" class="w-full py-3 bg-primary text-background font-bold rounded-xl hover:bg-primary/90 transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                Masuk Sekarang
            </button>
        </form>

        <div class="mt-8 pt-6 border-t border-border text-center relative z-10">
            <p class="text-sm text-secondary">
                Belum punya akun? 
                <a href="{{ route('student.register') }}" class="font-bold text-primary hover:underline">Daftar Sekarang</a>
            </p>
        </div>
    </div>
</body>
</html>