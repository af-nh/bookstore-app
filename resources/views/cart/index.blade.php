@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-10">
    <h1 class="font-display text-3xl font-semibold text-ink mb-6">Your cart</h1>

    @if (session('success'))
        <div class="bg-forest/10 text-forest border border-forest/30 rounded-sm px-4 py-3 mb-6 text-sm">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-clay/10 text-clay border border-clay/30 rounded-sm px-4 py-3 mb-6 text-sm">
            {{ session('error') }}
        </div>
    @endif

    @if ($items->isEmpty())
        <p class="text-ink-soft">Your cart is empty. <a href="{{ route('books.index') }}" class="text-forest hover:text-brass transition">Browse books</a></p>
    @else
        <div class="bg-paper border border-line overflow-hidden mb-6">
            <table class="w-full text-left">
                <thead class="bg-forest/5 border-b border-line">
                    <tr>
                        <th class="px-5 py-3 text-sm font-semibold text-ink-soft">Book</th>
                        <th class="px-5 py-3 text-sm font-semibold text-ink-soft">Price</th>
                        <th class="px-5 py-3 text-sm font-semibold text-ink-soft">Quantity</th>
                        <th class="px-5 py-3 text-sm font-semibold text-ink-soft">Subtotal</th>
                        <th class="px-5 py-3"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr class="border-b border-line last:border-0">
                            <td class="px-5 py-3 text-ink">{{ $item['book']->title }}</td>
                            <td class="px-5 py-3 text-ink-soft">${{ number_format($item['book']->price, 2) }}</td>
                            <td class="px-5 py-3">
                                <form action="{{ route('cart.update', $item['book']) }}" method="POST" class="flex items-center gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                           max="{{ $item['book']->stock }}" class="w-16 border border-line rounded-sm px-2 py-1 text-sm bg-white">
                                    <button type="submit" class="text-forest hover:text-brass text-sm transition">Update</button>
                                </form>
                            </td>
                            <td class="px-5 py-3 text-ink font-medium">${{ number_format($item['subtotal'], 2) }}</td>
                            <td class="px-5 py-3 text-right">
                                <form action="{{ route('cart.remove', $item['book']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-clay hover:text-clay/70 text-sm transition">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="flex items-center justify-between bg-paper border border-line p-5">
            <span class="font-display text-lg font-semibold text-ink">Total: ${{ number_format($total, 2) }}</span>
            <form action="{{ route('cart.checkout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-forest hover:bg-forest-dark text-paper px-5 py-2 rounded-sm transition">Checkout</button>
            </form>
        </div>
    @endif
</div>
@endsection
