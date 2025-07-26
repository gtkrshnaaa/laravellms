<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=1240" />
    <title>@yield('title', 'Admin Panel')</title>
    <link rel="icon" type="image/png" href="/images/Favicon_ResearchID.png">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-full flex flex-col min-h-screen">

    <nav class="bg-white text-black p-4 flex justify-between items-center border-b border-gray-100 sticky top-0 z-50">
        <div class="text-lg font-bold">Admin Dashboard</div>
        <form action="{{ route('sysadmin.logout') }}" method="POST">
            @csrf
            <button
                type="submit"
                class="bg-gray-600 hover:bg-gray-700 px-3 py-1 rounded text-sm text-white font-semibold"
            >
                Logout
            </button>
        </form>
    </nav>

    <div class="flex flex-1">

        <aside class="w-64 bg-white border-r border-gray-200 p-4 sticky top-16 h-[calc(100vh-4rem)] overflow-auto">
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('sysadmin.dashboard') }}"
                        class="block px-3 py-2 rounded hover:bg-gray-100 @if(request()->routeIs('sysadmin.dashboard')) bg-gray-200 font-semibold @endif"
                    >
                        Dashboard
                    </a>
                </li>
                {{-- Hanya untuk superadmin --}}
                @if(Auth::guard('sysadmin')->user()->level === 'superadmin')
                <li>
                    <a href="{{ route('sysadmin.manage_sysadmin.index') }}"
                        class="block px-3 py-2 rounded hover:bg-gray-100 @if(request()->routeIs('sysadmin.manage_sysadmin.*')) bg-gray-200 font-semibold @endif"
                    >
                        Manage Admin
                    </a>
                </li>
                @endif

                <li>
                    <a href="{{ route('sysadmin.manage_course_admin.index') }}"
                    class="block px-3 py-2 rounded hover:bg-gray-100 @if(request()->routeIs('sysadmin.manage_course_admin.*')) bg-gray-200 font-semibold @endif">
                        Manage Course Admin
                    </a>
                </li>
                <li>
                    <a href="{{ route('sysadmin.manage_lecturer.index') }}"
                    class="block px-3 py-2 rounded hover:bg-gray-100 @if(request()->routeIs('sysadmin.manage_lecturer.*')) bg-gray-200 font-semibold @endif">
                        Manage Lecturer
                    </a>
                </li>
                <li>
                    <a href="{{ route('sysadmin.manage_student.index') }}"
                    class="block px-3 py-2 rounded hover:bg-gray-100 @if(request()->routeIs('sysadmin.manage_student.*')) bg-gray-200 font-semibold @endif">
                        Manage Student
                    </a>
                </li>
                <li>
                    <a href="{{ route('sysadmin.manage-categories.index') }}"
                    class="block px-3 py-2 rounded hover:bg-gray-100 @if(request()->routeIs('sysadmin.manage-categories.*')) bg-gray-200 font-semibold @endif">
                        Manage Course Category
                    </a>
                </li>
            </ul>
        </aside>

        <main class="flex-1 p-6 bg-[#fdfdfd] overflow-auto">
            @yield('content')
        </main>
    </div>


</body>
</html>