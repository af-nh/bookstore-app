<div class="bg-paper border border-line border-l-4 border-l-brass p-5">
    <div class="flex items-center justify-between mb-4 pb-4 border-b border-line">
        <div>
            <p class="font-display text-lg font-semibold text-ink">Order #{{ $order->id }}</p>
            <p class="text-sm text-ink-soft">
                @if ($showCustomer ?? false)
                    {{ $order->user->name ?? 'Deleted user' }}
                    @if ($order->user)
                        &middot; {{ $order->user->email }}
                    @endif
                    &middot;
                @endif
                {{ $order->created_at->format('M j, Y \a\t g:ia') }}
            </p>
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
