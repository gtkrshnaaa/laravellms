<!DOCTYPE html>
<html lang="en" class="h-full bg-background" x-data="{ darkMode: localStorage.getItem('theme') === 'dark' }" :class="{ 'dark': darkMode }">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SysAdmin Login</title>
    <link rel="icon" type="image/png" href="/images/Favicon_ResearchID.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: '#2563EB',
                        secondary: '#64748B',
                        background: 'rgb(var(--background) / <alpha-value>)',
                        surface: 'rgb(var(--surface) / <alpha-value>)',
                        border: 'rgb(var(--border) / <alpha-value>)',
                    }
                }
            }
        }
        
        // Check for dark mode preference
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    <style>
        :root {
            --background: 248 250 252;
            --surface: 255 255 255;
            --border: 226 232 240;
            --primary: 37 99 235;
            --secondary: 71 85 105;
        }
        .dark {
            --background: 15 23 42;
            --surface: 30 41 59;
            --border: 51 65 85;
            --primary: 59 130 246;
            --secondary: 148 163 184;
        }
    </style>
</head>
<body class="h-full font-sans antialiased text-secondary bg-background selection:bg-primary/20 selection:text-primary flex flex-col justify-center py-12 sm:px-6 lg:px-8 transition-colors duration-300">
    
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h2 class="mt-6 text-center text-3xl font-extrabold text-primary tracking-tight">
            System Admin
        </h2>
        <p class="mt-2 text-center text-sm text-secondary">
            Sign in to access the control panel
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-[400px]">
        <div class="bg-surface py-8 px-4 shadow-xl shadow-black/5 sm:rounded-2xl sm:px-10 border border-border">
            
            @if($errors->any())
                <div class="mb-6 bg-red-500/10 border border-red-500/20 rounded-lg p-4 flex items-start gap-3">
                    <svg class="h-5 w-5 text-red-500 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <div>
                        <h3 class="text-sm font-medium text-red-600 dark:text-red-400">Login Failed</h3>
                        <ul class="mt-1 text-sm text-red-500 dark:text-red-300 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form class="space-y-6" action="{{ route('sysadmin.login.post') }}" method="POST">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-secondary">Email address</label>
                    <div class="mt-1 relative">
                        <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}" 
                            class="appearance-none block w-full px-3 py-2.5 bg-background border border-border rounded-lg shadow-sm placeholder-secondary/40 text-primary focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary sm:text-sm transition-all duration-200"
                            placeholder="admin@example.com">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-secondary">Password</label>
                    <div class="mt-1 relative" x-data="{ show: false }">
                        <input :type="show ? 'text' : 'password'" id="password" name="password" required 
                            class="appearance-none block w-full px-3 py-2.5 bg-background border border-border rounded-lg shadow-sm placeholder-secondary/40 text-primary focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary sm:text-sm transition-all duration-200 pr-10"
                            placeholder="••••••••">
                        <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-secondary hover:text-primary transition-colors focus:outline-none">
                            <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg x-show="show" style="display: none;" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div>
                    <button type="submit" 
                        class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-all duration-200 hover:shadow-lg hover:shadow-primary/30">
                        Sign in
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
