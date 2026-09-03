<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'BookStore')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    <header class="bg-gray-800 text-white shadow">
    <nav class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between">
        <h1 class="text-xl font-bold">
            <a href="{{ url('/') }}">📚 My BookStore App</a>
        </h1>

        <div class="flex gap-6">
            <a href="{{ url('/books') }}" class="hover:text-gray-300 transition">Books</a>
            <a href="{{ url('/login') }}" class="hover:text-gray-300 transition">Login</a>
        </div>
    </nav>
</header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>&copy; 2026 BookStore</p>
    </footer>

</body>
</html>