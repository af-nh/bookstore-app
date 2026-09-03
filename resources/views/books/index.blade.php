@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Bookstore</h1>

    <div class="flex flex-wrap gap-2 mb-8">
        <a href="{{ route('books.index') }}"
           class="px-4 py-2 rounded-lg text-sm {{ !request('category') ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700' }}">
            All
        </a>
        @foreach ($categories as $category)
            <a href="{{ route('books.index', ['category' => $category->id]) }}"
               class="px-4 py-2 rounded-lg text-sm {{ request('category') == $category->id ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700' }}">
                {{ $category->name }}
            </a>
        @endforeach
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($books as $book)
            @include('books._book-card', ['book' => $book])
        @empty
            <p class="text-gray-500 col-span-full">No books found.</p>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $books->links() }}
    </div>
</div>
@endsection