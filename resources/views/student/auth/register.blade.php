<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - LMS Laravel</title>
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
            <h1 class="text-2xl font-bold tracking-tight mb-2 text-primary">Buat Akun Baru</h1>
            <p class="text-secondary text-sm">Bergabunglah untuk mulai belajar skill baru.</p>
        </div>

        <form action="{{ route('student.register') }}" method="POST" class="space-y-4 relative z-10">
            @csrf
            
            <div>
                <label for="name" class="block text-sm font-bold text-primary mb-1.5">Nama Lengkap</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-secondary">
                        <i class="uil uil-user"></i>
                    </span>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required 
                        class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-background border @error('name') border-red-500 @else border-border @enderror text-primary focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder-secondary"
                        placeholder="John Doe">
                </div>
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-bold text-primary mb-1.5">Email</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-secondary">
                        <i class="uil uil-envelope"></i>
                    </span>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required 
                        class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-background border @error('email') border-red-500 @else border-border @enderror text-primary focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder-secondary"
                        placeholder="nama@email.com">
                </div>
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-bold text-primary mb-1.5">Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-secondary">
                        <i class="uil uil-padlock"></i>
                    </span>
                    <input type="password" name="password" id="password" required 
                        class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-background border @error('password') border-red-500 @else border-border @enderror text-primary focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder-secondary"
                        placeholder="••••••••">
                </div>
                @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-bold text-primary mb-1.5">Konfirmasi Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-secondary">
                        <i class="uil uil-check-circle"></i>
                    </span>
                    <input type="password" name="password_confirmation" id="password_confirmation" required 
                        class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-background border border-border text-primary focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder-secondary"
                        placeholder="••••••••">
                </div>
            </div>

            <button type="submit" class="w-full mt-2 py-3 bg-primary text-background font-bold rounded-xl hover:bg-primary/90 transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                Daftar & Mulai Belajar
            </button>
        </form>

        <div class="mt-8 pt-6 border-t border-border text-center relative z-10">
            <p class="text-sm text-secondary">
                Sudah punya akun? 
                <a href="{{ route('student.login') }}" class="font-bold text-primary hover:underline">Masuk di sini</a>
            </p>
        </div>
    </div>
</body>
</html>