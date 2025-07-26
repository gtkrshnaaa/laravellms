<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Login</title>
    <link rel="icon" type="image/png" href="/images/Favicon_ResearchID.png">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-full flex items-center justify-center">
    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8">
        <h1 class="text-2xl font-bold mb-6 text-center">System Admin Login</h1>

        @if($errors->any())
            <div class="mb-4 bg-gray-100 border border-gray-400 text-gray-700 px-4 py-3 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('sysadmin.login.post') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="email" class="block mb-2 font-medium text-gray-700">Email</label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-black"
                />
            </div>

            <div>
                <label for="password" class="block mb-2 font-medium text-gray-700">Password</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-black"
                />
            </div>

            <div>
                <label class="inline-flex items-center">
                    <input type="checkbox" class="mr-2" onclick="togglePassword()">
                    <span class="text-sm text-gray-700">Tampilkan password</span>
                </label>
            </div>

            <button
                type="submit"
                class="w-full bg-black text-white py-2 rounded-md font-semibold hover:bg-gray-800 transition"
            >
                Login
            </button>
        </form>
    </div>

    <script>
        function togglePassword() {
            const pw = document.getElementById('password');
            pw.type = pw.type === 'password' ? 'text' : 'password';
        }
    </script>
</body>
</html>
