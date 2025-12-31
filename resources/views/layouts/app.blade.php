<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" 
      x-data="{
          theme: localStorage.getItem('theme') || 'dark', 
          toggleTheme() {
              this.theme = this.theme === 'dark' ? 'light' : 'dark';
              localStorage.setItem('theme', this.theme);
              if (this.theme === 'dark') document.documentElement.classList.add('dark');
              else document.documentElement.classList.remove('dark');
          },
          mobileMenuOpen: false
      }"
      x-init="$watch('theme', val => val === 'dark' ? document.documentElement.classList.add('dark') : document.documentElement.classList.remove('dark')); if(theme === 'dark') document.documentElement.classList.add('dark');"
      :class="theme">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'LMS Laravel')</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        background: 'var(--background)',
                        surface: 'var(--surface)',
                        border: 'var(--border)',
                        primary: 'var(--primary)',
                        secondary: 'var(--secondary)',
                        accent: 'var(--accent)',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        mono: ['JetBrains Mono', 'monospace'],
                    }
                }
            }
        }
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">

    <style>
        :root {
            /* Light Mode (Expressive) */
            --background: #ffffff; /* Pure White */
            --surface: #ffffff;
            --border: #e4e4e7;     /* Zinc 200 */
            --primary: #18181b;    /* Zinc 900 */
            --secondary: #71717a;  /* Zinc 500 */
            --accent: #000000;
        }

        .dark {
            /* Industrial Dark Mode */
            --background: #0a0a0a;
            --surface: #171717;
            --border: rgba(255, 255, 255, 0.08); /* More subtle border */
            --primary: #ededed;
            --secondary: #a1a1aa;
            --accent: #ffffff;
        }

        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-background text-primary antialiased min-h-screen flex flex-col transition-colors duration-300">
    <div class="flex flex-col min-h-screen">
        {{-- Navbar --}}
        <header class="bg-surface/80 backdrop-blur-md border-b border-border sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg bg-primary flex items-center justify-center text-background font-bold font-mono">L</div>
                        <a href="{{ route('landingpage') }}" class="text-xl font-bold tracking-tight text-primary">LMS<span class="text-secondary">Laravel</span></a>
                    </div>
                    
                    {{-- Desktop Search --}}
                    <div class="hidden md:block flex-1 max-w-md mx-8">
                        <form action="{{ route('landingpage') }}" method="GET" class="relative group">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-secondary group-focus-within:text-primary transition-colors">
                                <i class="uil uil-search"></i>
                            </span>
                            <input type="search" name="search" value="{{ request('search') }}" placeholder="Cari kursus..." 
                                class="w-full pl-10 pr-4 py-2 bg-background border border-border rounded-lg text-sm text-primary placeholder-secondary focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none">
                        </form>
                    </div>

                    {{-- Desktop Menu --}}
                    <div class="hidden md:flex items-center gap-4">
                        <button @click="toggleTheme()" class="text-secondary hover:text-primary transition-colors">
                            <i class="uil" :class="theme === 'dark' ? 'uil-sun' : 'uil-moon'"></i>
                        </button>
                        @guest('student')
                            <a href="{{ route('student.login') }}" class="text-sm font-medium text-secondary hover:text-primary transition-colors">
                                Masuk
                            </a>
                            <a href="{{ route('student.register') }}" class="px-4 py-2 rounded-lg bg-primary text-background text-sm font-medium hover:bg-primary/90 transition-colors">
                                Daftar
                            </a>
                        @endguest
                        @auth('student')
                            <a href="{{ route('student.dashboard') }}" class="text-sm font-medium text-secondary hover:text-primary transition-colors">
                                Dashboard
                            </a>
                            <form action="{{ route('student.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="text-sm font-medium text-red-500 hover:text-red-400">Logout</button>
                            </form>
                        @endauth
                    </div>
                    
                    {{-- Mobile toggle --}}
                    <div class="flex items-center gap-4 md:hidden">
                        <button @click="toggleTheme()" class="text-secondary hover:text-primary transition-colors">
                            <i class="uil" :class="theme === 'dark' ? 'uil-sun' : 'uil-moon'"></i>
                        </button>
                        <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-primary p-2">
                            <i class="uil uil-bars text-xl"></i>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Mobile Menu --}}
            <div x-show="mobileMenuOpen" @click.away="mobileMenuOpen = false" class="md:hidden border-t border-border bg-surface p-4 space-y-4">
                <form action="{{ route('landingpage') }}" method="GET" class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-secondary">
                        <i class="uil uil-search"></i>
                    </span>
                    <input type="search" name="search" value="{{ request('search') }}" placeholder="Cari kursus..." 
                        class="w-full pl-10 pr-4 py-2 bg-background border border-border rounded-lg text-sm text-primary placeholder-secondary outline-none">
                </form>
                 @guest('student')
                    <a href="{{ route('student.login') }}" class="block text-center w-full py-2 border border-border rounded-lg text-primary font-medium">Masuk</a>
                    <a href="{{ route('student.register') }}" class="block text-center w-full py-2 bg-primary text-background rounded-lg font-medium">Daftar</a>
                @endguest
                @auth('student')
                    <a href="{{ route('student.dashboard') }}" class="block py-2 text-primary font-medium">Dashboard</a>
                    <form action="{{ route('student.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full text-left py-2 text-red-500 font-medium">Logout</button>
                    </form>
                @endauth
            </div>
        </header>

        {{-- Content --}}
        <main class="flex-grow">
            @yield('content')
        </main>

        {{-- Footer --}}
        <footer class="bg-surface border-t border-border mt-auto">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                    <div class="text-center md:text-left">
                        <h3 class="text-lg font-bold text-primary">LMS Laravel</h3>
                        <p class="text-sm text-secondary mt-1">&copy; {{ date('Y') }} All rights reserved.</p>
                    </div>
                    <div class="flex gap-6 text-sm text-secondary">
                        <a href="#" class="hover:text-primary transition-colors">Terms</a>
                        <a href="#" class="hover:text-primary transition-colors">Privacy</a>
                        <a href="#" class="hover:text-primary transition-colors">Contact</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    @stack('scripts')
</body>
</html>
