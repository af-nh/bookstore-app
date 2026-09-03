@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8">
    <a href="{{ route('books.index') }}" class="text-sm text-blue-600 hover:underline mb-6 inline-block">
        &larr; Back to all books
    </a>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $book->title }}</h1>
        <p class="text-gray-500 mb-4">by {{ $book->author->name }}</p>

        <div class="flex flex-wrap gap-2 mb-6">
            @foreach ($book->categories as $category)
                <span class="text-xs bg-blue-50 text-blue-700 px-2 py-1 rounded-full">
                    {{ $category->name }}
                </span>
            @endforeach
        </div>

        <p class="text-gray-700 leading-relaxed mb-6">{{ $book->description }}</p>

        <div class="flex items-center justify-between border-t border-gray-100 pt-6">
            <span class="text-2xl font-bold text-gray-800">${{ number_format($book->price, 2) }}</span>
            <span class="text-sm {{ $book->stock > 0 ? 'text-green-600' : 'text-red-500' }}">
                {{ $book->stock > 0 ? $book->stock . ' in stock' : 'Out of stock' }}
            </span>
        </div>
        <div class="mt-6 pt-6 border-t border-gray-100">
    @if ($book->stock > 0)
        <form action="{{ route('cart.add', $book) }}" method="POST" class="flex items-center gap-3">
            @csrf
            <input type="number" name="quantity" value="1" min="1" max="{{ $book->stock }}"
                   class="w-20 border border-gray-300 rounded-lg px-3 py-2">
            <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-lg">Add to cart</button>
        </form>
    @else
        <p class="text-red-500 text-sm">Out of stock</p>
    @endif
</div>
        <div class="mt-6 pt-6 border-t border-gray-100">
            <h3 class="text-sm font-semibold text-gray-500 mb-1">About the author</h3>
            <p class="text-gray-600 text-sm">{{ $book->author->bio }}</p>
        </div>
    </div>
</div>
@endsection