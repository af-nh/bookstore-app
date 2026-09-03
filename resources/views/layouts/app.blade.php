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

        <nav class="bg-gray-900 text-white px-6 py-4 flex items-center justify-between">
    <a href="{{ route('books.index') }}" class="font-bold text-lg">📚 My BookStore App</a>

    <div class="flex items-center gap-6 text-sm">
        <a href="{{ route('books.index') }}" class="hover:text-gray-300">Books</a>
        <a href="{{ route('cart.index') }}" class="hover:text-gray-300">
    Cart @if (session('cart') && count(session('cart')) > 0)
        <span class="bg-blue-600 text-white text-xs rounded-full px-2 py-0.5 ml-1">{{ count(session('cart')) }}</span>
    @endif
</a>

        @auth
            @if (auth()->user()->role === 'admin')
                <a href="{{ route('dashboard.index') }}" class="hover:text-gray-300">Dashboard</a>
            @endif

            <span class="text-gray-400">{{ auth()->user()->name }}</span>

            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="hover:text-gray-300">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="hover:text-gray-300">Login</a>
            <a href="{{ route('register') }}" class="hover:text-gray-300">Register</a>
        @endauth
    </div>
</nav>
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