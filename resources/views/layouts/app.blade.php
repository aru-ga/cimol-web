<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Cimol Enak!')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 font-sans antialiased">
    <header class="bg-white shadow sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-xl font-bold text-yellow-600">Cimol Enak!</a>
            <nav class="space-x-4">
                <a href="{{ route('catalogue') }}" class="text-gray-700 hover:text-yellow-600">Catalogue</a>
                <a href="{{ route('cart') }}" class="text-gray-700 hover:text-yellow-600">Cart</a>
                <a href="{{ route('about') }}" class="text-sm text-gray-700 hover:text-yellow-600">About</a>
                @auth
                    <span class="text-sm text-gray-600">Hi, {{ Auth::user()->name }}!</span>
                    <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-red-500 text-sm">Logout</button>
                    </form>
                @else
                    <a href="{{ route('admin.login') }}" class="text-gray-700 hover:text-yellow-600 text-sm">Admin Login</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="py-10 px-4 max-w-7xl mx-auto">
        @yield('content')
    </main>

    <footer class="bg-white text-center py-4 border-t mt-10">
        <p class="text-sm text-gray-500">&copy; 2025 Cimol Enak. All rights reserved.</p>
    </footer>
</body>

</html>