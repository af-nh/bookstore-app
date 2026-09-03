@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto px-4 py-12">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Log in</h1>

    <form action="{{ route('login') }}" method="POST" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2">
            @error('email') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input type="password" name="password"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2">
            @error('password') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg">Log in</button>

        <p class="text-sm text-gray-500 text-center">
            Don't have an account? <a href="{{ route('register') }}" class="text-blue-600">Register</a>
        </p>
    </form>
</div>
@endsection