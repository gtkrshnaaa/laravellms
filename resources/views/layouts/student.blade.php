<!DOCTYPE html>
<html lang="id" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Student Dashboard') - LMS Laravel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
     <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body class="h-full">
    <div x-data="{ sidebarOpen: false }" class="flex h-full">
        
        {{-- Sidebar --}}
        <aside :class="sidebarOpen ? 'block' : 'hidden'" class="w-64 bg-white border-r-2 border-gray-100 flex flex-col justify-between md:flex">
            
            {{-- Bagian Atas: Logo & Navigasi --}}
            <div>
                <div class="p-8 border-b-2 border-gray-100">
                    <a href="{{ route('student.dashboard') }}" class="text-2xl font-bold text-gray-600">LMS Siswa</a>
                </div>
                
                <nav class="p-4 space-y-2">
                    <a href="{{ route('student.dashboard') }}" class="flex items-center px-4 py-2 rounded-lg @if(request()->routeIs('student.dashboard')) bg-gray-100 text-gray-800 font-bold @else text-gray-600 hover:bg-gray-100 @endif">
                        <i class="uil uil-estate mr-3"></i>Dashboard
                    </a>
                    <a href="{{ route('student.courses.index') }}" class="flex items-center px-4 py-2 rounded-lg @if(request()->routeIs('student.courses.*')) bg-gray-100 text-gray-800 font-bold @else text-gray-600 hover:bg-gray-100 @endif">
                        <i class="uil uil-search mr-3"></i>Cari Kursus
                    </a>
                    <a href="{{ route('student.enrolled_course.index') }}" class="flex items-center px-4 py-2 rounded-lg @if(request()->routeIs('student.enrolled_course.*')) bg-gray-100 text-gray-800 font-bold @else text-gray-600 hover:bg-gray-100 @endif">
                        <i class="uil uil-notebooks mr-3"></i>Kursus Saya
                    </a>
                    <a href="{{ route('student.certificates.index') }}" class="flex items-center px-4 py-2 rounded-lg @if(request()->routeIs('student.certificates.index')) bg-gray-100 text-gray-800 font-bold @else text-gray-600 hover:bg-gray-100 @endif">
                        <i class="uil uil-award mr-3"></i>Sertifikat Saya
                    </a>
                    <a href="{{ route('student.profile.edit') }}" class="flex items-center px-4 py-2 rounded-lg @if(request()->routeIs('student.profile.edit')) bg-gray-100 text-gray-800 font-bold @else text-gray-600 hover:bg-gray-100 @endif">
                        <i class="uil uil-user-circle mr-3"></i>Profil Saya
                    </a>
                </nav>
            </div>

            {{-- Bagian Bawah: Tombol & Logout --}}
            <div class="p-4">
                <div class="bg-gray-600 rounded-lg p-4 text-center mb-2">
                    <p class="text-white text-sm font-semibold mb-3">
                        Jelajahi lebih banyak kursus.
                    </p>
                    <a href="{{ route('landingpage') }}" target="_blank" class="inline-flex items-center justify-center bg-white text-gray-600 hover:bg-gray-100 px-4 py-2 rounded-md text-sm font-semibold transition duration-300">
                        <i class="uil uil-estate w-4 h-4 mr-2 flex items-center justify-center text-base"></i>
                        Halaman Utama
                    </a>
                </div>

                <div class="border-t-2 border-gray-100 pt-2">
                        <form action="{{ route('student.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full flex items-center px-4 py-2 rounded-lg text-gray-600 hover:bg-gray-100">
                                <i class="uil uil-signout mr-3"></i>Logout
                            </button>
                        </form>
                </div>
            </div>
        </aside>

        {{-- Main Content --}}
        <div class="flex-1 flex flex-col">
            <header class="bg-white border-b-2 border-gray-100 p-7 flex justify-between items-center md:justify-end">
                <button @click="sidebarOpen = !sidebarOpen" class="md:hidden text-gray-600">
                    <i class="uil uil-bars text-2xl"></i>
                </button>
                
                <a href="{{ route('student.profile.edit') }}" class="flex items-center group">
                    <span class="text-gray-700 font-medium group-hover:text-gray-600 transition-colors">{{ Auth::guard('student')->user()->name }}</span>
                    <div class="ml-3 p-2 bg-gray-100 rounded-full">
                        <i class="uil uil-user text-gray-600"></i>
                    </div>
                </a>
                
            </header>
            <main class="flex-1 p-6 md:p-8 overflow-y-auto">
                @yield('content')
            </main>
        </div>
    </div>
    <script src="//unpkg.com/alpinejs" defer></script>
</body>
</html>