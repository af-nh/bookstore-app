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
                <div class="bg-paper border border-line border-l-4 border-l-brass p-5">
                    <div class="flex items-center justify-between mb-4 pb-4 border-b border-line">
                        <div>
                            <p class="font-display text-lg font-semibold text-ink">Order #{{ $order->id }}</p>
                            <p class="text-sm text-ink-soft">{{ $order->created_at->format('M j, Y \a\t g:ia') }}</p>
                        </div>
                        <p class="font-display text-lg font-semibold text-ink">${{ number_format($order->total, 2) }}</p>
                    </div>

                    <div class="space-y-2">
                        @foreach ($order->items as $item)
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-ink">{{ $item->book->title ?? 'Book no longer available' }} &times; {{ $item->quantity }}</span>
                                <span class="text-ink-soft">${{ number_format($item->price * $item->quantity, 2) }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
