@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-10">
    <a href="{{ route('books.index') }}" class="text-sm text-forest hover:text-brass transition mb-8 inline-block">
        &larr; Back to the shelf
    </a>

    <div class="bg-paper border border-line border-l-4 border-l-brass p-8">
        <h1 class="font-display text-3xl font-semibold text-ink mb-1">{{ $book->title }}</h1>
        <p class="text-ink-soft mb-4">by {{ $book->author->name }}</p>

        <div class="flex flex-wrap gap-1.5 mb-6">
            @foreach ($book->categories as $category)
                <span class="text-xs text-forest border border-forest/30 px-2 py-0.5 rounded-sm">
                    {{ $category->name }}
                </span>
            @endforeach
        </div>

        <p class="text-ink leading-relaxed mb-6">{{ $book->description }}</p>

        <div class="flex items-center justify-between border-t border-line pt-6">
            <span class="font-display text-2xl font-semibold text-ink">${{ number_format($book->price, 2) }}</span>
            <span class="text-sm {{ $book->stock > 0 ? 'text-forest' : 'text-clay' }}">
                {{ $book->stock > 0 ? $book->stock . ' in stock' : 'Out of stock' }}
            </span>
        </div>

        <div class="mt-6 pt-6 border-t border-line">
            @if ($book->stock > 0)
                <form action="{{ route('cart.add', $book) }}" method="POST" class="flex items-center gap-3">
                    @csrf
                    <input type="number" name="quantity" value="1" min="1" max="{{ $book->stock }}"
                           class="w-20 border border-line rounded-sm px-3 py-2 bg-white">
                    <button type="submit" class="bg-forest hover:bg-forest-dark text-paper px-5 py-2 rounded-sm transition">Add to cart</button>
                </form>
            @else
                <p class="text-clay text-sm">Out of stock</p>
            @endif
        </div>

        <div class="mt-6 pt-6 border-t border-line">
            <h3 class="text-sm font-semibold text-ink-soft mb-1">About the author</h3>
            <p class="text-ink-soft text-sm">{{ $book->author->bio }}</p>
        </div>
    </div>
</div>
@endsection
