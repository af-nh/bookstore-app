@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Your cart</h1>

    @if (session('success'))
        <div class="bg-green-50 text-green-700 border border-green-200 rounded-lg px-4 py-3 mb-6 text-sm">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-50 text-red-600 border border-red-200 rounded-lg px-4 py-3 mb-6 text-sm">
            {{ session('error') }}
        </div>
    @endif

    @if ($items->isEmpty())
        <p class="text-gray-500">Your cart is empty. <a href="{{ route('books.index') }}" class="text-blue-600">Browse books</a></p>
    @else
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-5 py-3 text-sm font-semibold text-gray-500">Book</th>
                        <th class="px-5 py-3 text-sm font-semibold text-gray-500">Price</th>
                        <th class="px-5 py-3 text-sm font-semibold text-gray-500">Quantity</th>
                        <th class="px-5 py-3 text-sm font-semibold text-gray-500">Subtotal</th>
                        <th class="px-5 py-3"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr class="border-b border-gray-100 last:border-0">
                            <td class="px-5 py-3 text-gray-800">{{ $item['book']->title }}</td>
                            <td class="px-5 py-3 text-gray-600">${{ number_format($item['book']->price, 2) }}</td>
                            <td class="px-5 py-3">
                                <form action="{{ route('cart.update', $item['book']) }}" method="POST" class="flex items-center gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                           max="{{ $item['book']->stock }}" class="w-16 border border-gray-300 rounded px-2 py-1 text-sm">
                                    <button type="submit" class="text-blue-600 text-sm">Update</button>
                                </form>
                            </td>
                            <td class="px-5 py-3 text-gray-800 font-medium">${{ number_format($item['subtotal'], 2) }}</td>
                            <td class="px-5 py-3 text-right">
                                <form action="{{ route('cart.remove', $item['book']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 text-sm">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="flex items-center justify-between bg-white rounded-xl shadow-sm border border-gray-200 p-5">
            <span class="text-lg font-bold text-gray-800">Total: ${{ number_format($total, 2) }}</span>
            <form action="{{ route('cart.checkout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-lg">Checkout</button>
            </form>
        </div>
    @endif
</div>
@endsection