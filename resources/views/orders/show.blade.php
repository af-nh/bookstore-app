@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-14">
    <div class="text-center mb-8">
        <p class="text-forest text-sm font-medium mb-2">Order confirmed</p>
        <h1 class="font-display text-3xl font-semibold text-ink">Thank you, {{ $order->user->name }}.</h1>
        <p class="text-ink-soft mt-1">Your order has been placed.</p>
    </div>

    @include('orders._order-card', ['order' => $order])

    <div class="text-center mt-8">
        <a href="{{ route('books.index') }}" class="text-forest hover:text-brass transition">&larr; Continue browsing</a>
    </div>
</div>
@endsection
