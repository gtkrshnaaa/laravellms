<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'LMS Laravel')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-white">
    <div class="min-h-screen flex flex-col">
        {{-- Navbar Publik Baru --}}
        <header class="bg-white border-b border-blue-100 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <div class="flex items-center">
                        <a href="{{ route('landingpage') }}" class="text-2xl font-bold text-black">LMS Laravel</a>
                        <div class="hidden md:block ml-10">
                            {{-- Nanti bisa jadi dropdown kategori --}}
                            {{-- <a href="#" class="text-gray-700 hover:text-gray-600 px-3 py-2 rounded-md text-sm font-medium">Kategori</a> --}}
                        </div>
                    </div>
                    <div class="hidden md:block flex-1 max-w-lg mx-4">
                        <form action="{{ route('landingpage') }}" method="GET" class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <i class="uil uil-search text-blue-400"></i>
                            </span>
                            <input type="search" name="search" value="{{ request('search') }}" placeholder="Cari kursus apa saja..." class="w-full pl-10 pr-4 py-2 border border-blue-100 rounded-full bg-white focus:bg-white focus:border-blue-500 focus:outline-none transition">
                        </form>
                    </div>
                    <div class="hidden md:flex items-center space-x-2">
                        @guest('student')
                            <a href="{{ route('student.login') }}" class="px-4 py-2 rounded-md text-sm font-medium text-black hover:bg-blue-50 border border-blue-100">
                                Masuk
                            </a>
                            <a href="{{ route('student.register') }}" class="px-4 py-2 rounded-md text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 border border-blue-600">
                                Daftar
                            </a>
                        @endguest
                        @auth('student')
                            <a href="{{ route('student.dashboard') }}" class="px-4 py-2 rounded-md text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                                Dashboard Saya
                            </a>
                            <form action="{{ route('student.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="px-4 py-2 rounded-md text-sm font-medium text-black hover:bg-blue-50">Logout</button>
                            </form>
                        @endauth
                    </div>
                </div>
            </div>
        </header>

        {{-- Konten Halaman --}}
        <main class="flex-grow bg-white">
            @yield('content')
        </main>

        <footer class="bg-white text-black">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    {{-- Kolom 1: Tentang Laravel --}}
                    <div class="md:col-span-2">
                        <h3 class="text-2xl font-bold text-black">LMS Laravel</h3>
                        <p class="mt-4 text-black text-sm leading-relaxed">
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi nulla perspiciatis eveniet illo reiciendis perferendis earum quidem, dolorem minus unde!
                        </p>
                    </div>

                    {{-- Kolom 2: Tautan Cepat --}}
                    <div>
                        <h4 class="text-lg font-semibold tracking-wider uppercase">Tautan</h4>
                        <ul class="mt-4 space-y-2 text-sm">
                            <li><a href="#" class="text-black hover:text-blue-600 transition">Tentang Kami</a></li>
                            <li><a href="#" class="text-black hover:text-blue-600 transition">Program Pelatihan</a></li>
                            <li><a href="{{ route('landingpage') }}" class="text-black hover:text-blue-600 transition">Katalog Kursus</a></li>
                            <li><a href="#" class="text-black hover:text-blue-600 transition">Kontak</a></li>
                        </ul>
                    </div>

                    {{-- Kolom 3: Kontak --}}
                    <div>
                        <h4 class="text-lg font-semibold tracking-wider uppercase">Kontak Kami</h4>
                        <ul class="mt-4 space-y-3 text-sm">
                            <li class="flex items-start">
                                <i class="uil uil-map-marker mt-1 mr-3"></i>
                                <span class="text-black">Jl. Jalan-jalan kemana aja, Kesana Kemari, Indonesia, Bumi</span>
                            </li>
                            <li class="flex items-start">
                                <i class="uil uil-envelope-alt mt-1 mr-3"></i>
                                <span class="text-black">info@Laravel.co.id</span>
                            </li>
                            <li class="flex items-start">
                                <i class="uil uil-phone-alt mt-1 mr-3"></i>
                                <span class="text-black">1484 1561 1561 445</span>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Bagian Bawah Footer --}}
                <div class="mt-8 pt-8 border-t border-blue-100 flex flex-col md:flex-row justify-between items-center">
                    <p class="text-sm text-black">&copy; {{ date('Y') }} Laravel. All rights reserved.</p>
                    <div class="flex space-x-4 mt-4 md:mt-0">
                        {{-- Ganti '#' dengan link sosial media yang benar --}}
                        <a href="#" class="text-black hover:text-blue-600 transition"><i class="uil uil-facebook-f text-xl"></i></a>
                        <a href="#" class="text-black hover:text-blue-600 transition"><i class="uil uil-instagram text-xl"></i></a>
                        <a href="#" class="text-black hover:text-blue-600 transition"><i class="uil uil-youtube text-xl"></i></a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    @stack('scripts')
</body>
</html>

