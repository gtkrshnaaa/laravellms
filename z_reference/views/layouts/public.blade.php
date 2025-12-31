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
    <title>@yield('title', 'Onedayez') - Your Academic Cheat Code</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
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
        .gradient-text {
            background: linear-gradient(to right, #ededed, #666666);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        /* Light Mode Gradient Override */
        html:not(.dark) .gradient-text {
            background: linear-gradient(to right, #000000, #52525b);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: var(--background);
        }
        ::-webkit-scrollbar-thumb {
            background: var(--border);
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: var(--secondary);
        }

        .tech-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -2; /* Behind canvas */
            /* Light Mode Default */
            background-color: #ffffff;
            background-image: radial-gradient(#d4d4d8 1px, transparent 1px);
            background-size: 24px 24px;
            mask-image: linear-gradient(to bottom, rgba(0,0,0,1) 40%, rgba(0,0,0,0) 100%);
            -webkit-mask-image: linear-gradient(to bottom, rgba(0,0,0,1) 40%, rgba(0,0,0,0) 100%);
        }

        .dark .tech-bg {
            background-color: #050505;
            background-image: radial-gradient(#333 1px, transparent 1px);
        }

        .tech-glow {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100vw;
            height: 100vh;
            /* Light Mode Glow (Subtle Blue/Gray) */
            background: radial-gradient(circle at center, rgba(200, 200, 200, 0.4) 0%, rgba(255,255,255,0) 70%);
            z-index: -2;
            pointer-events: none;
        }

        .dark .tech-glow {
            background: radial-gradient(circle at center, rgba(30, 30, 30, 0.2) 0%, rgba(0,0,0,0) 70%);
        }
    </style>
</head>
<body class="bg-background text-primary min-h-screen flex flex-col relative transition-colors duration-300">
    <!-- Original Tech Background -->
    <div class="tech-bg"></div>
    <div class="tech-glow"></div>

    <!-- Constellation Canvas (Overlay) -->
    <canvas id="constellation-bg" class="fixed inset-0 z-[-1] pointer-events-none transition-opacity duration-1000"></canvas>
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const canvas = document.getElementById('constellation-bg');
            const ctx = canvas.getContext('2d');
            let width, height;
            let particles = [];
            
            // Configuration
            const particleCount = window.innerWidth < 768 ? 35 : 70; 
            const connectionDistance = 140; 
            const twitchSpeed = 0.03; 

            // Color Palettes
            const colors = {
                dark: ['255, 255, 255', '200, 200, 255', '180, 220, 255', '255, 200, 220'], // Cool whites/blues
                light: ['0, 0, 0', '50, 50, 100', '20, 40, 60', '80, 40, 100'] // Dark blues/blacks
            };

            const getTheme = () => document.documentElement.classList.contains('dark') ? 'dark' : 'light';

            class Particle {
                constructor() {
                    this.x = Math.random() * width;
                    this.y = Math.random() * height;
                    this.size = Math.random() * 2 + 1; // Slightly larger
                    this.alpha = Math.random();
                    this.targetAlpha = Math.random();
                    
                    // Assign random base color from palette
                    const theme = getTheme();
                    this.baseColor = colors[theme][Math.floor(Math.random() * colors[theme].length)];
                }

                update() {
                    // Update color if theme changed (rare but needed)
                    // In a real optimized scenario we might just reload, but this works
                    const theme = getTheme();
                    // Simple check if current baseColor belongs to current theme palette roughly
                    // For performance, we'll just let init re-run on resize, or we can add a theme listener.
                    // For this specific effect, let's keep it simple: assumes page reload on theme or handles it in animate
                    
                    if (Math.abs(this.alpha - this.targetAlpha) < 0.05) {
                        this.targetAlpha = Math.random();
                    }
                    this.alpha += (this.targetAlpha - this.alpha) * twitchSpeed;
                }

                draw() {
                    ctx.beginPath();
                    ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                    ctx.fillStyle = `rgba(${this.baseColor}, ${this.alpha})`;
                    ctx.fill();
                }
            }

            function init() {
                resize();
                createParticles();
            }
            
            function createParticles() {
                particles = [];
                const theme = getTheme();
                for (let i = 0; i < particleCount; i++) {
                    let p = new Particle();
                    p.baseColor = colors[theme][Math.floor(Math.random() * colors[theme].length)];
                    particles.push(p);
                }
            }

            function resize() {
                width = canvas.width = window.innerWidth;
                height = canvas.height = window.innerHeight;
            }

            function animate() {
                ctx.clearRect(0, 0, width, height);

                particles.forEach(p => {
                    p.update();
                    p.draw();
                });

                // Connections
                for (let i = 0; i < particles.length; i++) {
                    for (let j = i + 1; j < particles.length; j++) {
                        const dx = particles[i].x - particles[j].x;
                        const dy = particles[i].y - particles[j].y;
                        const distance = Math.sqrt(dx * dx + dy * dy);

                        if (distance < connectionDistance) {
                            const opacity = (1 - (distance / connectionDistance)) * 0.4; // BRIGHTER lines (was 0.15)
                            
                            // Gradient Line
                            const gradient = ctx.createLinearGradient(particles[i].x, particles[i].y, particles[j].x, particles[j].y);
                            gradient.addColorStop(0, `rgba(${particles[i].baseColor}, ${opacity})`);
                            gradient.addColorStop(1, `rgba(${particles[j].baseColor}, ${opacity})`);

                            ctx.beginPath();
                            ctx.strokeStyle = gradient;
                            ctx.lineWidth = 1; // Thicker lines
                            ctx.moveTo(particles[i].x, particles[i].y);
                            ctx.lineTo(particles[j].x, particles[j].y);
                            ctx.stroke();
                        }
                    }
                }

                requestAnimationFrame(animate);
            }

            window.addEventListener('resize', () => {
                resize();
                createParticles();
            });

            // Re-create particles on theme change to update colors
            const observer = new MutationObserver((mutations) => {
                mutations.forEach((mutation) => {
                    if (mutation.attributeName === 'class') {
                       createParticles();
                    }
                });
            });
            observer.observe(document.documentElement, { attributes: true });

            init();
            animate();
        });
    </script>
    
    <!-- Navbar -->
    <nav class="border-b border-border bg-background/80 backdrop-blur-md sticky top-0 z-50" x-data="{ mobileMenuOpen: false }">
        <div class="container mx-auto px-4 h-16 flex items-center justify-between">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="text-xl font-bold tracking-tighter text-primary">ONEDAYEZ</a>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center gap-8">
                <!-- Theme Toggle -->
                <button @click="toggleTheme()" class="text-secondary hover:text-primary transition-colors">
                    <!-- Sun Icon (Show in Dark Mode) -->
                    <svg x-show="theme === 'dark'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                    </svg>
                    <!-- Moon Icon (Show in Light Mode) -->
                    <svg x-show="theme === 'light'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z" />
                    </svg>
                </button>
                <a href="{{ route('home') }}" class="text-sm font-medium {{ request()->routeIs('home') ? 'text-primary' : 'text-secondary hover:text-primary' }} transition-colors">Beranda</a>
                    <a href="{{ route('catalog.index') }}" class="text-sm font-medium transition-colors hover:text-primary {{ request()->routeIs('catalog.*') ? 'text-primary' : 'text-secondary' }}">
                        Katalog
                    </a>
                    <a href="{{ route('portfolio.index') }}" class="text-sm font-medium transition-colors hover:text-primary {{ request()->routeIs('portfolio.*') ? 'text-primary' : 'text-secondary' }}">
                        Portfolio
                    </a>
                    <a href="{{ route('services.index') }}" class="text-sm font-medium transition-colors hover:text-primary {{ request()->routeIs('services.*') ? 'text-primary' : 'text-secondary' }}">
                        Layanan
                    </a>
                @auth('buyer')
                    <a href="{{ route('buyer.dashboard') }}" class="text-sm font-medium text-secondary hover:text-primary transition-colors">
                        Ruang Kamu
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-secondary hover:text-primary transition-colors">Masuk</a>
                    <a href="{{ route('register') }}" class="bg-primary text-background px-4 py-2 rounded-full text-xs font-bold hover:opacity-90 transition-opacity">
                        Gabung Gratis
                    </a>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-primary p-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
        </div>

        <div 
            x-show="mobileMenuOpen" 
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            @click.away="mobileMenuOpen = false" 
            class="md:hidden absolute top-16 left-0 w-full bg-white dark:bg-zinc-950 border-b border-border p-4 flex flex-col gap-4 shadow-2xl"
        >
            <div class="flex items-center justify-between pb-2 border-b border-border">
                <span class="text-xs font-mono text-secondary">Tampilan Web</span>
                <button @click="toggleTheme()" class="text-secondary hover:text-primary transition-colors">
                    <svg x-show="theme === 'dark'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                    </svg>
                    <svg x-show="theme === 'light'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z" />
                    </svg>
                </button>
            </div>

            <a href="{{ route('home') }}" class="text-sm font-medium {{ request()->routeIs('home') ? 'text-primary' : 'text-secondary hover:text-primary' }} transition-colors py-2 border-b border-border/10">Beranda</a>
                <a href="{{ route('catalog.index') }}" class="block px-3 py-2 text-base font-medium rounded-md {{ request()->routeIs('catalog.*') ? 'text-primary bg-primary/10' : 'text-secondary hover:text-primary hover:bg-primary/5' }}">
                    Katalog
                </a>
                <a href="{{ route('portfolio.index') }}" class="block px-3 py-2 text-base font-medium rounded-md {{ request()->routeIs('portfolio.*') ? 'text-primary bg-primary/10' : 'text-secondary hover:text-primary hover:bg-primary/5' }}">
                    Portfolio
                </a>
                <a href="{{ route('services.index') }}" class="block px-3 py-2 text-base font-medium rounded-md {{ request()->routeIs('services.*') ? 'text-primary bg-primary/10' : 'text-secondary hover:text-primary hover:bg-primary/5' }}">
                    Layanan
                </a>
            @auth('buyer')
                <a href="{{ route('buyer.dashboard') }}" class="text-sm font-medium text-secondary hover:text-primary transition-colors py-2 border-b border-border/10">
                    Ruang Kamu
                </a>
            @else
                <a href="{{ route('login') }}" class="text-sm font-medium text-secondary hover:text-primary transition-colors py-2 border-b border-border/10">Masuk</a>
                <a href="{{ route('register') }}" class="bg-primary text-background px-4 py-2 rounded-full text-xs font-bold hover:opacity-90 transition-opacity inline-block text-center w-full">
                    Gabung Gratis
                </a>
            @endauth
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="border-t border-border bg-surface py-12">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-lg font-bold tracking-tighter text-primary mb-4">ONEDAYEZ</h2>
            <div class="flex justify-center gap-6 mb-8 text-sm text-secondary">
                <a href="{{ route('catalog.index') }}" class="hover:text-primary transition-colors">Jelajah Katalog</a>
                <a href="{{ route('terms') }}" class="hover:text-primary transition-colors">S & K</a>
                <a href="#" class="hover:text-primary transition-colors">Privasi</a>
            </div>
            <p class="text-xs text-secondary/70">
                &copy; {{ date('Y') }} Onedayez. "Cheat Code Akademikmu".
            </p>
        </div>
    </footer>
</body>
</html>
