<!DOCTYPE html>
<html lang="id" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Lecturer Panel') - LMS Laravel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="h-full">
    <div class="flex h-full">
        <aside class="w-64 bg-white border-r-2 border-gray-100 flex flex-col">
            <div class="p-6 border-b-2 border-gray-100">
                <a href="{{ route('lecturer.dashboard') }}" class="text-2xl font-bold text-gray-600">Lecturer Panel</a>
            </div>
            <nav class="p-4 space-y-2">
                <a href="{{ route('lecturer.dashboard') }}" class="flex items-center px-4 py-2 rounded-lg @if(request()->routeIs('lecturer.dashboard')) bg-gray-100 text-gray-800 font-bold @else text-gray-600 hover:bg-gray-100 @endif">
                    <i class="uil uil-estate mr-3"></i>Dashboard
                </a>
                <a href="{{ route('lecturer.courses.index') }}" class="flex items-center px-4 py-2 rounded-lg @if(request()->routeIs('lecturer.courses.*')) bg-gray-100 text-gray-800 font-bold @else text-gray-600 hover:bg-gray-100 @endif">
                    <i class="uil uil-notebooks mr-3"></i>Kursus Saya
                </a>
            </nav>
        </aside>


        <div class="flex-1 flex flex-col">
            <header class="bg-white border-b-2 border-gray-100 p-6 flex justify-between items-center">
                <h1 class="text-xl font-semibold">@yield('title')</h1>
                <div class="flex items-center space-x-4">
                    <span class="font-medium">{{ Auth::guard('lecturer')->user()->name }}</span>
                    <form action="{{ route('lecturer.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-gray-600 hover:text-gray-600">
                            <i class="uil uil-signout text-2xl"></i>
                        </button>
                    </form>
                </div>
            </header>
            <main class="flex-1 p-6 md:p-8 overflow-y-auto">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>