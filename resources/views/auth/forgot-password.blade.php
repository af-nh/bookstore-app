@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto px-4 py-14">
    <h1 class="font-display text-2xl font-semibold text-ink mb-2">Reset your password</h1>
    <p class="text-sm text-ink-soft mb-6">Enter your email and we'll send you a reset link.</p>

    @if (session('success'))
        <div class="bg-forest/10 text-forest border border-forest/30 rounded-sm px-4 py-3 mb-6 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('password.email') }}" method="POST" class="bg-paper border border-line p-6 space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-medium text-ink-soft mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}"
                   class="w-full border border-line rounded-sm px-3 py-2 bg-white">
            @error('email') <p class="text-sm text-clay mt-1">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="w-full bg-forest hover:bg-forest-dark text-paper py-2 rounded-sm transition">Send reset link</button>

        <p class="text-sm text-ink-soft text-center">
            <a href="{{ route('login') }}" class="text-forest hover:text-brass transition">Back to login</a>
        </p>
    </form>
</div>
@endsection
