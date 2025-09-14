<!DOCTYPE html>
<html lang="en" class="h-full bg-white">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Login</title>
    <link rel="icon" type="image/png" href="/images/Favicon_ResearchID.png">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-full flex items-center justify-center">
    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8 border border-blue-100">
        <h1 class="text-2xl font-bold mb-6 text-center text-black">System Admin Login</h1>

        @if($errors->any())
            <div class="mb-4 bg-blue-50 border-l-4 border-blue-500 text-black px-4 py-3 rounded">
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
                <label for="email" class="block mb-2 font-medium text-black">Email</label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    class="w-full px-4 py-2 border border-blue-100 rounded-md focus:outline-none focus:border-blue-500"
                />
            </div>

            <div>
                <label for="password" class="block mb-2 font-medium text-black">Password</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    required
                    class="w-full px-4 py-2 border border-blue-100 rounded-md focus:outline-none focus:border-blue-500"
                />
            </div>

            <div>
                <label class="inline-flex items-center">
                    <input type="checkbox" class="mr-2 text-blue-600 focus:ring-blue-500" onclick="togglePassword()">
                    <span class="text-sm text-gray-600">Tampilkan password</span>
                </label>
            </div>

            <button
                type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded-md font-semibold hover:bg-blue-700 transition"
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
