<a href="{{ route('books.show', $book) }}"
   class="block bg-paper border border-line border-l-4 border-l-brass p-5 hover:border-l-forest transition">
    <h2 class="font-display text-lg font-semibold text-ink mb-1 leading-snug">{{ $book->title }}</h2>
    <p class="text-sm text-ink-soft mb-3">by {{ $book->author->name }}</p>

    <div class="flex flex-wrap gap-1.5 mb-4">
        @foreach ($book->categories as $category)
            <span class="text-xs text-forest border border-forest/30 px-2 py-0.5 rounded-sm">
                {{ $category->name }}
            </span>
        @endforeach
    </div>

    <div class="flex items-center justify-between pt-3 border-t border-line">
        <span class="font-display text-lg font-semibold text-ink">${{ number_format($book->price, 2) }}</span>
        <span class="text-sm {{ $book->stock > 0 ? 'text-forest' : 'text-clay' }}">
            {{ $book->stock > 0 ? $book->stock . ' in stock' : 'Out of stock' }}
        </span>
    </div>
</a>
