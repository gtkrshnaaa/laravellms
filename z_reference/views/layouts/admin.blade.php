<!DOCTYPE html>
<html lang="en" x-data="{
    theme: localStorage.getItem('theme') || 'dark',
    toggleTheme() {
        this.theme = this.theme === 'dark' ? 'light' : 'dark';
        localStorage.setItem('theme', this.theme);
        if (this.theme === 'dark') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    },
    init() {
        if (this.theme === 'dark') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    }
}" x-init="init()" :class="theme">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Onedayez</title>
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
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
            --border: #262626;
            --primary: #ededed;
            --secondary: #a1a1aa;
            --accent: #ffffff;
        }

        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-background text-primary min-h-screen flex">
    
    <!-- Sidebar -->
    <aside class="w-64 bg-background border-r border-border flex-shrink-0 flex flex-col justify-between hidden md:flex sticky top-0 h-screen overflow-y-auto">
        <div class="p-6">
            <div class="flex items-center justify-between mb-8">
                <h1 class="text-xl font-bold tracking-tighter text-primary">ONEDAYEZ</h1>
                <button @click="toggleTheme()" class="text-secondary hover:text-primary transition-colors">
                    <svg x-show="theme === 'dark'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                    </svg>
                    <svg x-show="theme === 'light'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z" />
                    </svg>
                </button>
            </div>
            
            <nav class="space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-primary text-background' : 'text-secondary hover:text-primary hover:bg-secondary/10' }} transition-colors">
                    Dashboard
                </a>
                <a href="{{ route('admin.categories.index') }}" class="block px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.categories.*') ? 'bg-primary text-background' : 'text-secondary hover:text-primary hover:bg-secondary/10' }} transition-colors">
                    Kategori
                </a>
                <a href="{{ route('admin.products.index') }}" class="block px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.products.*') ? 'bg-primary text-background' : 'text-secondary hover:text-primary hover:bg-secondary/10' }} transition-colors">
                    Produk
                </a>
                

                <div class="pt-4 pb-2">
                    <p class="px-4 text-xs font-bold text-secondary uppercase tracking-wider">Showcase</p>
                </div>

                <a href="{{ route('admin.portfolios.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-surface transition-colors {{ request()->routeIs('admin.portfolios.*') ? 'bg-surface text-primary' : 'text-secondary' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                    Portfolio
                </a>

                <div class="pt-4 pb-2">
                    <p class="px-4 text-xs font-bold text-secondary uppercase tracking-wider">Layanan</p>
                </div>

                <a href="{{ route('admin.service.orders.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-surface transition-colors {{ request()->routeIs('admin.service.orders.*') ? 'bg-surface text-primary' : 'text-secondary' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                    </svg>
                    Order Masuk
                </a>

                <a href="{{ route('admin.service.packages.index', ['service_type_slug' => 'jasa-web-development']) }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-surface transition-colors {{ request()->fullUrlIs(route('admin.service.packages.index', ['service_type_slug' => 'jasa-web-development'])) ? 'bg-surface text-primary' : 'text-secondary' }}">
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75L22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3l-4.5 16.5" />
                    </svg>
                    Jasa Web
                </a>

                <a href="{{ route('admin.service.packages.index', ['service_type_slug' => 'konsultasi']) }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-surface transition-colors {{ request()->fullUrlIs(route('admin.service.packages.index', ['service_type_slug' => 'konsultasi'])) ? 'bg-surface text-primary' : 'text-secondary' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                    </svg>
                    Konsultasi
                </a>
            </nav>
        </div>

        <div class="p-6 border-t border-border">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-8 h-8 rounded-full bg-surface flex items-center justify-center text-xs font-bold">
                    {{ substr(Auth::guard('admin')->user()->name, 0, 1) }}
                </div>
                <div>
                    <p class="text-sm font-medium text-primary">{{ Auth::guard('admin')->user()->name }}</p>
                    <p class="text-xs text-secondary">Admin</p>
                </div>
            </div>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-0 text-red-500 text-xs hover:text-red-400 transition-colors">
                    Keluar Dulu
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col min-w-0 overflow-hidden">
        
        <!-- Mobile Header -->
        <header class="md:hidden bg-background border-b border-border p-4 flex items-center justify-between">
             <h1 class="text-lg font-bold tracking-tighter text-primary">ONEDAYEZ</h1>
             <div class="flex items-center gap-4">
                <button @click="toggleTheme()" class="text-secondary hover:text-primary transition-colors">
                    <svg x-show="theme === 'dark'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                    </svg>
                    <svg x-show="theme === 'light'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z" />
                    </svg>
                </button>
                 <button class="text-primary">Menu</button> {{-- Needs Alpine for real toggle --}}
             </div>
        </header>

        <div class="flex-1 overflow-auto p-6 md:p-12">
            @if(session('success'))
                <div class="mb-6 bg-green-900/30 border border-green-900 text-green-300 px-4 py-3 rounded-lg text-sm" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>

</body>
</html>
