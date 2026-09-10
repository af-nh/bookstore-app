@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto px-4 py-14">
    <h1 class="font-display text-2xl font-semibold text-ink mb-6">Log in</h1>

    <form action="{{ route('login') }}" method="POST" class="bg-paper border border-line p-6 space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-medium text-ink-soft mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}"
                   class="w-full border border-line rounded-sm px-3 py-2 bg-white">
            @error('email') <p class="text-sm text-clay mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <div class="flex items-center justify-between mb-1">
                <label class="block text-sm font-medium text-ink-soft">Password</label>
                <a href="{{ route('password.request') }}" class="text-xs text-forest hover:text-brass transition">Forgot password?</a>
            </div>
            <input type="password" name="password"
                   class="w-full border border-line rounded-sm px-3 py-2 bg-white">
            @error('password') <p class="text-sm text-clay mt-1">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="w-full bg-forest hover:bg-forest-dark text-paper py-2 rounded-sm transition">Log in</button>

        <p class="text-sm text-ink-soft text-center">
            Don't have an account? <a href="{{ route('register') }}" class="text-forest hover:text-brass transition">Register</a>
        </p>
    </form>
</div>
@endsection
