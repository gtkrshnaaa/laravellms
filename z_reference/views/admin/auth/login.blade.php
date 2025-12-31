<!DOCTYPE html>
<html lang="en" class="light" x-data="{
    darkMode: localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches),
    toggleTheme() {
        this.darkMode = !this.darkMode;
        localStorage.setItem('theme', this.darkMode ? 'dark' : 'light');
        if (this.darkMode) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    }
}" x-init="$watch('darkMode', val => val ? document.documentElement.classList.add('dark') : document.documentElement.classList.remove('dark')); if(darkMode) document.documentElement.classList.add('dark');">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Onedayez</title>
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        background: 'rgb(var(--color-background) / <alpha-value>)',
                        surface: 'rgb(var(--color-surface) / <alpha-value>)',
                        border: 'rgb(var(--color-border) / <alpha-value>)',
                        primary: 'rgb(var(--color-primary) / <alpha-value>)',
                        secondary: 'rgb(var(--color-secondary) / <alpha-value>)',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        mono: ['JetBrains Mono', 'monospace'],
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=JetBrains+Mono:wght@400&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        :root {
            --color-background: 255 255 255; /* Pure White */
            --color-surface: 255 255 255; /* White */
            --color-border: 228 228 231; /* Zinc 200 */
            --color-primary: 24 24 27; /* Zinc 900 */
            --color-secondary: 113 113 122; /* Zinc 500 */
        }
        .dark {
            --color-background: 10 10 10;
            --color-surface: 23 23 23;
            --color-border: 38 38 38;
            --color-primary: 237 237 237;
            --color-secondary: 161 161 170;
        }
    </style>
</head>
<body class="bg-background text-primary min-h-screen flex items-center justify-center p-4 transition-colors duration-300">
    <!-- Theme Toggle -->
    <div class="absolute top-6 right-6">
        <button @click="toggleTheme()" class="p-2 rounded-full bg-surface border border-border text-primary hover:bg-black/5 dark:hover:bg-white/5 transition-colors">
            <!-- Sun Icon -->
            <svg x-show="!darkMode" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
            </svg>
            <!-- Moon Icon -->
            <svg x-show="darkMode" style="display: none;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z" />
            </svg>
        </button>
    </div>

    <div class="w-full max-w-md bg-surface border border-border p-8 rounded-xl shadow-2xl">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold tracking-tight text-primary mb-2">Masuk ke Dapur</h1>
            <p class="text-secondary text-sm">Akses khusus dapur rekaman.</p>
        </div>

        <form method="POST" action="{{ route('admin.login') }}" class="space-y-6">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-medium text-secondary mb-2">Email Admin</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="w-full bg-background border border-border rounded-lg px-4 py-3 text-primary focus:ring-1 focus:ring-primary focus:border-primary transition-colors outline-none placeholder-zinc-500">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-secondary mb-2">Kata Sandi</label>
                <input id="password" type="password" name="password" required
                    class="w-full bg-background border border-border rounded-lg px-4 py-3 text-primary focus:ring-1 focus:ring-primary focus:border-primary transition-colors outline-none placeholder-zinc-500">
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="w-full bg-primary text-background font-bold py-3 px-4 rounded-lg hover:opacity-90 transition-opacity">
                    Gass Masuk
                </button>
            </div>
        </form>
    </div>
</body>
</html>
