<!DOCTYPE html>
<html lang="id" x-data="{
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
    <title>Login Siswa &bull; UR Organization</title>
    
    <!-- Scripts & Styles from Reference -->
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
                        brand: {
                            500: '#18181b',
                        }
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
            --border: #262626;
            --primary: #ededed;
            --secondary: #a1a1aa;
            --accent: #ffffff;
        }

        body { font-family: 'Inter', sans-serif; }
        
        .tech-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -2;
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
            background: radial-gradient(circle at center, rgba(200, 200, 200, 0.4) 0%, rgba(255,255,255,0) 70%);
            z-index: -2;
            pointer-events: none;
        }

        .dark .tech-glow {
            background: radial-gradient(circle at center, rgba(30, 30, 30, 0.2) 0%, rgba(0,0,0,0) 70%);
        }
    </style>
</head>
<body class="bg-background text-primary min-h-screen flex items-center justify-center p-4 relative transition-colors duration-300 overflow-hidden selection:bg-primary selection:text-background">

    <!-- Background Effects -->
    <div class="tech-bg"></div>
    <div class="tech-glow"></div>
    <canvas id="constellation-bg" class="fixed inset-0 z-[-1] pointer-events-none transition-opacity duration-1000"></canvas>

    <!-- Header / Navbar back -->
    <div class="absolute top-6 left-6 z-50">
        <a href="{{ route('landingpage') }}" class="flex items-center gap-2 text-primary hover:text-secondary transition-colors font-medium text-sm bg-surface/50 backdrop-blur-sm px-4 py-2 rounded-full border border-border/50 hover:border-border">
             <i class="uil uil-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- Theme Toggle -->
    <div class="absolute top-6 right-6 z-50">
        <button @click="toggleTheme()" class="p-2 rounded-full bg-surface/50 backdrop-blur-sm border border-border/50 hover:bg-surface hover:border-primary text-secondary hover:text-primary transition-all shadow-sm">
            <i x-show="theme === 'dark'" class="uil uil-sun text-xl"></i>
            <i x-show="theme === 'light'" class="uil uil-moon text-xl"></i>
        </button>
    </div>

    <!-- Login Card -->
    <div class="w-full max-w-md bg-surface/80 backdrop-blur-xl border border-border rounded-3xl shadow-2xl p-8 relative z-10 animate-float" style="animation: float 6s ease-in-out infinite;">
        
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-primary text-background mb-4 text-2xl">
                <i class="uil uil-graduation-cap"></i>
            </div>
            <h1 class="text-2xl font-bold tracking-tight mb-2">Student Portal</h1>
            <p class="text-secondary text-sm">Masuk untuk mengakses materi pembelajaran.</p>
        </div>

        @if($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-600 dark:text-red-400 text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('student.login') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label for="email" class="block text-xs font-bold uppercase tracking-wider text-secondary mb-1.5 ml-1">Email</label>
                <div class="relative group">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-secondary group-focus-within:text-primary transition-colors">
                        <i class="uil uil-envelope"></i>
                    </span>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required 
                        class="w-full pl-10 pr-4 py-3 rounded-xl bg-background border border-border text-primary focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder-secondary/50"
                        placeholder="nama@email.com">
                </div>
            </div>

            <div>
                <label for="password" class="block text-xs font-bold uppercase tracking-wider text-secondary mb-1.5 ml-1">Password</label>
                <div class="relative group">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-secondary group-focus-within:text-primary transition-colors">
                        <i class="uil uil-padlock"></i>
                    </span>
                    <input type="password" name="password" id="password" required 
                        class="w-full pl-10 pr-4 py-3 rounded-xl bg-background border border-border text-primary focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder-secondary/50"
                        placeholder="••••••••">
                </div>
            </div>

            <button type="submit" class="w-full py-3.5 bg-primary text-background font-bold rounded-xl hover:opacity-90 transition-all shadow-lg shadow-primary/20 hover:shadow-primary/40 mt-2 flex items-center justify-center gap-2 group">
                Masuk Sekarang
                <i class="uil uil-arrow-right group-hover:translate-x-1 transition-transform"></i>
            </button>
        </form>

        <div class="mt-8 pt-6 border-t border-border text-center">
            <p class="text-xs text-secondary">
                Akun untuk internal organisasi. <br> Silakan hubungi Admin jika belum memiliki akun.
            </p>
        </div>
    </div>

    <!-- Script for Constellation Canvas (Copied from Landing Page) -->
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

            // Color Palettes (RGB strings)
            const colors = {
                dark: ['255, 255, 255', '200, 200, 200', '150, 150, 150'], 
                light: ['0, 0, 0', '50, 50, 50', '100, 100, 100'] 
            };

            const getTheme = () => document.documentElement.classList.contains('dark') ? 'dark' : 'light';

            class Particle {
                constructor() {
                    this.x = Math.random() * width;
                    this.y = Math.random() * height;
                    this.size = Math.random() * 2 + 1;
                    this.alpha = Math.random();
                    this.targetAlpha = Math.random();
                    
                    const theme = getTheme();
                    this.baseColor = colors[theme][Math.floor(Math.random() * colors[theme].length)];
                }

                update() {
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
                width = window.innerWidth;
                height = window.innerHeight;
                for (let i = 0; i < particleCount; i++) {
                    let p = new Particle();
                    p.baseColor = colors[theme][Math.floor(Math.random() * colors[theme].length)];
                    p.x = Math.random() * width; 
                    p.y = Math.random() * height;
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
                            const opacity = (1 - (distance / connectionDistance)) * 0.2;
                            
                            const gradient = ctx.createLinearGradient(particles[i].x, particles[i].y, particles[j].x, particles[j].y);
                            gradient.addColorStop(0, `rgba(${particles[i].baseColor}, ${opacity})`);
                            gradient.addColorStop(1, `rgba(${particles[j].baseColor}, ${opacity})`);

                            ctx.beginPath();
                            ctx.strokeStyle = gradient;
                            ctx.lineWidth = 1; 
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
</body>
</html>