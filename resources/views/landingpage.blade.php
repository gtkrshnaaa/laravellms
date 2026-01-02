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
    <title>UR Organization &bull; Learning Hub</title>
    
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
                        // Keeping brand colors for specific accents if needed, but muted
                        brand: {
                            500: '#18181b', // Zinc 900
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        mono: ['JetBrains Mono', 'monospace'],
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-20px)' },
                        }
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
<body class="bg-background text-primary min-h-screen flex flex-col relative transition-colors duration-300 overflow-x-hidden selection:bg-primary selection:text-background">

    <!-- Background Effects -->
    <div class="tech-bg"></div>
    <div class="tech-glow"></div>
    <canvas id="constellation-bg" class="fixed inset-0 z-[-1] pointer-events-none transition-opacity duration-1000"></canvas>

    <!-- Navbar -->
    <nav class="border-b border-border bg-background/80 backdrop-blur-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center">
                    <i class="uil uil-layer-group text-lg text-background"></i>
                </div>
                <span class="text-lg font-bold tracking-tight text-primary">UR Organization <span class="font-light text-secondary">LMS</span></span>
            </div>
            
            <div class="flex items-center gap-4">
                <!-- Theme Toggle -->
                <button @click="toggleTheme()" class="p-2 rounded-lg hover:bg-surface border border-transparent hover:border-border text-secondary hover:text-primary transition-all">
                    <!-- Sun (Dark Mode) -->
                    <i x-show="theme === 'dark'" class="uil uil-sun text-xl"></i>
                    <!-- Moon (Light Mode) -->
                    <i x-show="theme === 'light'" class="uil uil-moon text-xl"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Halaman Utama -->
    <main class="flex-1 w-full max-w-7xl mx-auto px-6 py-20 lg:py-32 flex flex-col lg:flex-row items-center gap-16">
        
        <!-- Left Content -->
        <div class="flex-1 text-center lg:text-left">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-surface border border-border text-xs font-mono text-secondary mb-8">
                <span class="relative flex h-2 w-2">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-2 w-2 bg-primary"></span>
                </span>
                UR ORGANIZATION OFFICIAL PORTAL
            </div>
            
            <h1 class="text-5xl lg:text-7xl font-extrabold tracking-tighter leading-[1.1] mb-8">
                Elevate Your <br>
                <span class="gradient-text">Professional Skills</span>
            </h1>
            
            <p class="text-lg text-secondary max-w-xl mx-auto lg:mx-0 mb-10 leading-relaxed font-light">
                Platform pembelajaran terpusat untuk anggota organisasi. Akses materi eksklusif, lacak progres, dan raih sertifikasi kompetensi.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                <a href="{{ route('student.login') }}" class="px-8 py-4 bg-primary text-background hover:opacity-90 rounded-xl font-semibold transition-all hover:-translate-y-1 flex items-center justify-center gap-2">
                    Start Learning
                    <i class="uil uil-arrow-right"></i>
                </a>
                <a href="#portals" class="px-8 py-4 bg-surface hover:bg-border/50 text-primary border border-border rounded-xl font-semibold transition-all hover:-translate-y-1 flex items-center justify-center gap-2">
                    Staff Login
                </a>
            </div>
        </div>

        <!-- Right Visual (Abstract Card Stack) -->
        <div class="flex-1 relative w-full max-w-md lg:max-w-none flex justify-center">
            <div class="relative w-full max-w-[400px] aspect-square animate-float">
                <!-- Main Card -->
                <div class="absolute inset-0 bg-surface rounded-3xl border border-border shadow-2xl flex flex-col p-6 z-20">
                    <div class="flex justify-between items-center mb-6">
                        <div class="h-8 w-8 bg-border rounded-full flex items-center justify-center"><i class="uil uil-user text-secondary"></i></div>
                        <div class="h-2 w-16 bg-border rounded-full"></div>
                    </div>
                    <div class="space-y-4">
                        <div class="h-24 bg-background border border-border rounded-xl p-4 flex gap-4 items-center">
                             <div class="h-12 w-12 bg-primary/10 rounded-lg flex items-center justify-center text-primary"><i class="uil uil-java-script text-2xl"></i></div>
                             <div>
                                 <div class="h-3 w-24 bg-primary rounded-full mb-2"></div>
                                 <div class="h-2 w-16 bg-border rounded-full"></div>
                             </div>
                        </div>
                        <div class="h-24 bg-background border border-border rounded-xl p-4 flex gap-4 items-center">
                             <div class="h-12 w-12 bg-primary/10 rounded-lg flex items-center justify-center text-primary"><i class="uil uil-react text-2xl"></i></div>
                             <div>
                                 <div class="h-3 w-24 bg-primary rounded-full mb-2"></div>
                                 <div class="h-2 w-16 bg-border rounded-full"></div>
                             </div>
                        </div>
                    </div>
                    <div class="mt-auto">
                        <div class="h-10 w-full bg-primary rounded-xl flex items-center justify-center text-background text-sm font-bold">Continue</div>
                    </div>
                </div>
                
                <!-- Back Card -->
                <div class="absolute inset-0 bg-border rounded-3xl transform translate-x-4 translate-y-4 -z-10 opacity-50"></div>
            </div>
        </div>

    </main>

    <!-- Login Portals -->
    <section id="portals" class="w-full max-w-7xl mx-auto px-6 py-20 border-t border-border">
        <div class="text-center mb-16">
            <h2 class="text-2xl font-bold tracking-tight mb-2">Access Portal</h2>
            <p class="text-secondary">Pilih pintu masuk sesuai peran Anda.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
                $roles = [
                    ['name' => 'Student', 'icon' => 'uil-graduation-cap', 'desc' => 'Akses materi & belajar.', 'route' => 'student.login'],
                    ['name' => 'Lecturer', 'icon' => 'uil-presentation-play', 'desc' => 'Kelola kelas & siswa.', 'route' => 'lecturer.login'],
                    ['name' => 'Course Admin', 'icon' => 'uil-book-reader', 'desc' => 'Manajemen konten.', 'route' => 'course_admin.login'],
                    ['name' => 'SysAdmin', 'icon' => 'uil-server', 'desc' => 'Pengaturan sistem.', 'route' => 'sysadmin.login'],
                ];
            @endphp

            @foreach($roles as $role)
            <a href="{{ route($role['route']) }}" class="group bg-surface p-6 rounded-2xl border border-border hover:border-primary transition-all hover:shadow-lg relative overflow-hidden">
                <div class="h-12 w-12 bg-background border border-border rounded-xl flex items-center justify-center text-2xl text-primary mb-4 group-hover:scale-110 transition-transform">
                    <i class="uil {{ $role['icon'] }}"></i>
                </div>
                <h3 class="text-lg font-bold mb-1">{{ $role['name'] }}</h3>
                <p class="text-sm text-secondary mb-4">{{ $role['desc'] }}</p>
                <div class="flex items-center text-xs font-bold uppercase tracking-wider text-primary">
                    Login <i class="uil uil-arrow-right ml-1 transition-transform group-hover:translate-x-1"></i>
                </div>
            </a>
            @endforeach
        </div>
    </section>

    <!-- Footer -->
    <footer class="border-t border-border bg-surface py-12 mt-auto">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h2 class="text-lg font-bold tracking-tighter text-primary mb-4">UR ORGANIZATION</h2>
            <p class="text-xs text-secondary">
                &copy; {{ date('Y') }} UR Organization Learning System.
            </p>
        </div>
    </footer>

    <!-- Script for Constellation Canvas -->
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
                    p.x = Math.random() * width; // Important: re-randomize pos on theme change
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
