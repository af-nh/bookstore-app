@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-10">
    <div class="mb-8 pb-6 border-b border-line">
        <h1 class="font-display text-3xl font-semibold text-ink">All orders</h1>
        <p class="text-ink-soft mt-1">{{ $orders->total() }} orders placed.</p>
    </div>

    <form action="{{ route('dashboard.orders.index') }}" method="GET" class="flex gap-2 mb-8">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by customer name or email"
               class="flex-1 border border-line rounded-sm px-3 py-2 bg-white">
        <button type="submit" class="bg-forest hover:bg-forest-dark text-paper px-5 py-2 rounded-sm text-sm transition">Search</button>
        @if (request('search'))
            <a href="{{ route('dashboard.orders.index') }}" class="text-ink-soft hover:text-ink px-3 py-2 text-sm transition">Clear</a>
        @endif
    </form>

    @if ($orders->isEmpty())
        <p class="text-ink-soft">
            @if (request('search'))
                No orders match "{{ request('search') }}".
            @else
                No orders placed yet.
            @endif
        </p>
    @else
        <div class="space-y-6">
            @foreach ($orders as $order)
                @include('orders._order-card', ['order' => $order, 'showCustomer' => true])
            @endforeach
        </div>

        <div class="mt-6">
            {{ $orders->links() }}
        </div>
    @endif
</div>
@endsection
