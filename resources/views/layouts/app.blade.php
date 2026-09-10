<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'The Bindery')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-parchment text-ink min-h-screen flex flex-col">

    <header class="bg-forest text-paper border-b-2 border-brass">
        <nav class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between">
            <a href="{{ route('books.index') }}" class="font-display text-2xl font-semibold tracking-tight">
                The Bindery
            </a>

            <div class="flex items-center gap-6 text-sm">
                <a href="{{ route('books.index') }}" class="hover:text-brass-light transition">Books</a>

                <a href="{{ route('cart.index') }}" class="hover:text-brass-light transition">
                    Cart
                    @if (session('cart') && count(session('cart')) > 0)
                        <span class="bg-brass text-forest-dark text-xs font-semibold rounded-full px-2 py-0.5 ml-1">{{ count(session('cart')) }}</span>
                    @endif
                </a>

                @auth
                    <a href="{{ route('account.index') }}" class="hover:text-brass-light transition">My Account</a>

                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('dashboard.index') }}" class="hover:text-brass-light transition">Dashboard</a>
                        <a href="{{ route('dashboard.orders.index') }}" class="hover:text-brass-light transition">Orders</a>
                    @endif

                    <span class="text-brass-light/80">{{ auth()->user()->name }}</span>

                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="hover:text-brass-light transition">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="hover:text-brass-light transition">Login</a>
                    <a href="{{ route('register') }}" class="hover:text-brass-light transition">Register</a>
                @endauth
            </div>
        </nav>
    </header>

    <main class="flex-1">
        @yield('content')
    </main>

    <footer class="border-t border-line mt-16">
        <p class="max-w-6xl mx-auto px-4 py-6 text-sm text-ink-soft">The Bindery, est. 2026 — a shelf of good books.</p>
    </footer>

</body>
</html>
