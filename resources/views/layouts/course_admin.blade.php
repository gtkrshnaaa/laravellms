<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50"> {{-- Warna background sangat soft, gray-50 --}}
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Course Admin Panel')</title>
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Google Fonts - Quicksand for a soft, modern feel --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;700&display=swap" rel="stylesheet">
    {{-- Unicons CSS --}}
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <style>
        body {
            font-family: 'Quicksand', sans-serif;
        }
        /* Scrollbar styles for a softer look */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb {
            background: #1f2021; /* Tailwind gray-500 */
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #1f2021; /* Tailwind gray-600 */
        }
    </style>
</head>
<body class="h-full flex flex-col min-h-screen">
    {{-- Navbar --}}
    <nav class="bg-white text-dark-text p-4 flex justify-between items-center border-b border-gray-100 shadow-sm sticky top-0 z-50">
        <div class="text-xl font-bold flex items-center">
            {{-- Unicons Home --}}
            <i class="uil uil-estate text-gray-600 w-6 h-6 mr-2 flex items-center justify-center text-2xl"></i>
            Course Admin Panel
        </div>
        <form action="{{ route('course_admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="bg-gray-600 hover:bg-gray-800 px-4 py-2 rounded-md text-sm text-white font-semibold transition duration-300 ease-in-out">
                Logout
            </button>
        </form>
    </nav>

    <div class="flex flex-1">
        {{-- Sidebar --}}
        <aside class="w-64 bg-white border-r border-gray-100 p-4 sticky top-[4.5rem] h-[calc(100vh-4.5rem)] overflow-y-auto shadow-sm flex flex-col justify-between"> {{-- Added flex-col and justify-between --}}
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('course_admin.dashboard') }}"
                        class="block px-4 py-2 rounded-lg hover:bg-light-red hover:text-gray-600 transition duration-200 flex items-center
                        @if(request()->routeIs('course_admin.dashboard')) bg-light-red text-gray-600 font-semibold @else text-dark-text @endif">
                        {{-- Unicons Home --}}
                        <i class="uil uil-estate w-5 h-5 mr-2 flex items-center justify-center text-lg"></i>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('course_admin.management.courses.index') }}"
                        class="block px-4 py-2 rounded-lg hover:bg-light-red hover:text-gray-600 transition duration-200 flex items-center
                        @if(request()->routeIs('course_admin.management.*')) bg-light-red text-gray-600 font-semibold @else text-dark-text @endif">
                        {{-- Unicons Book --}}
                        <i class="uil uil-book-open w-5 h-5 mr-2 flex items-center justify-center text-lg"></i>
                        Manajemen Kursus
                    </a>
                </li>
            </ul>

            {{-- Red box at the bottom of the sidebar --}}
            <div class="mt-auto"> {{-- mt-auto pushes it to the bottom --}}
                <div class="bg-gray-600 rounded-lg p-4 text-center shadow-md">
                    <p class="text-white text-sm font-semibold mb-3">
                        Lihat bagaimana tampilan web Anda.
                    </p>
                    <a href="{{ url('/') }}" target="_blank" class="inline-flex items-center justify-center bg-white text-gray-600 hover:bg-gray-100 px-4 py-2 rounded-md text-sm font-semibold transition duration-300">
                        {{-- Unicons Eye --}}
                        <i class="uil uil-eye w-4 h-4 mr-2 flex items-center justify-center text-base"></i>
                        Lihat Halaman
                    </a>
                </div>
            </div>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 p-8 bg-gray-50 overflow-y-auto">
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif
            @if ($errors->any())
                <div class="bg-gray-100 border-l-4 border-gray-500 text-gray-700 p-4 mb-6 rounded-md" role="alert">
                    <p class="font-bold">Terjadi Kesalahan</p>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @yield('content')
        </main>
    </div>
</body>
</html>