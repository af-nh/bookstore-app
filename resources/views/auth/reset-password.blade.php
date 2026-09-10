@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto px-4 py-14">
    <h1 class="font-display text-2xl font-semibold text-ink mb-6">Choose a new password</h1>

    <form action="{{ route('password.update') }}" method="POST" class="bg-paper border border-line p-6 space-y-5">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div>
            <label class="block text-sm font-medium text-ink-soft mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email', $email) }}"
                   class="w-full border border-line rounded-sm px-3 py-2 bg-white">
            @error('email') <p class="text-sm text-clay mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-ink-soft mb-1">New password</label>
            <input type="password" name="password"
                   class="w-full border border-line rounded-sm px-3 py-2 bg-white">
            @error('password') <p class="text-sm text-clay mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-ink-soft mb-1">Confirm new password</label>
            <input type="password" name="password_confirmation"
                   class="w-full border border-line rounded-sm px-3 py-2 bg-white">
        </div>

        <button type="submit" class="w-full bg-forest hover:bg-forest-dark text-paper py-2 rounded-sm transition">Reset password</button>
    </form>
</div>
@endsection
