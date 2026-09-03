<a href="{{ route('books.show', $book) }}"
   class="block bg-white rounded-xl shadow-sm border border-gray-200 p-5 hover:shadow-md transition">
    <h2 class="text-lg font-semibold text-gray-800 mb-1">{{ $book->title }}</h2>
    <p class="text-sm text-gray-500 mb-3">by {{ $book->author->name }}</p>

    <div class="flex flex-wrap gap-1 mb-3">
        @foreach ($book->categories as $category)
            <span class="text-xs bg-blue-50 text-blue-700 px-2 py-1 rounded-full">
                {{ $category->name }}
            </span>
        @endforeach
    </div>

    <div class="flex items-center justify-between">
        <span class="text-lg font-bold text-gray-800">${{ number_format($book->price, 2) }}</span>
        <span class="text-sm {{ $book->stock > 0 ? 'text-green-600' : 'text-red-500' }}">
            {{ $book->stock > 0 ? $book->stock . ' in stock' : 'Out of stock' }}
        </span>
    </div>
</a>