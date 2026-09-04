@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto px-4 py-14">
    <h1 class="font-display text-2xl font-semibold text-ink mb-6">Create an account</h1>

    <form action="{{ route('register') }}" method="POST" class="bg-paper border border-line p-6 space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-medium text-ink-soft mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name') }}"
                   class="w-full border border-line rounded-sm px-3 py-2 bg-white">
            @error('name') <p class="text-sm text-clay mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-ink-soft mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}"
                   class="w-full border border-line rounded-sm px-3 py-2 bg-white">
            @error('email') <p class="text-sm text-clay mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-ink-soft mb-1">Password</label>
            <input type="password" name="password"
                   class="w-full border border-line rounded-sm px-3 py-2 bg-white">
            @error('password') <p class="text-sm text-clay mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-ink-soft mb-1">Confirm password</label>
            <input type="password" name="password_confirmation"
                   class="w-full border border-line rounded-sm px-3 py-2 bg-white">
        </div>

        <button type="submit" class="w-full bg-forest hover:bg-forest-dark text-paper py-2 rounded-sm transition">Register</button>

        <p class="text-sm text-ink-soft text-center">
            Already have an account? <a href="{{ route('login') }}" class="text-forest hover:text-brass transition">Log in</a>
        </p>
    </form>
</div>
@endsection
