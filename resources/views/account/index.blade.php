@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-10">
    <div class="mb-8 pb-6 border-b border-line">
        <h1 class="font-display text-3xl font-semibold text-ink">Welcome back, {{ auth()->user()->name }}</h1>
        <p class="text-ink-soft mt-1">Here's what you've ordered so far.</p>
    </div>

    @if (session('success'))
        <div class="bg-forest/10 text-forest border border-forest/30 rounded-sm px-4 py-3 mb-6 text-sm">
            {{ session('success') }}
        </div>
    @endif

    @if ($orders->isEmpty())
        <p class="text-ink-soft">No orders yet. <a href="{{ route('books.index') }}" class="text-forest hover:text-brass transition">Browse the shelf</a></p>
    @else
        <div class="space-y-6">
            @foreach ($orders as $order)
                @include('orders._order-card', ['order' => $order])
            @endforeach
        </div>
    @endif
</div>
@endsection
