@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10">
    <div class="mb-8 pb-6 border-b border-line">
        <h1 class="font-display text-4xl font-semibold text-ink">On the shelf</h1>
        <p class="text-ink-soft mt-1">{{ $books->total() }} books, sorted by newest arrivals.</p>
    </div>

    <form action="{{ route('books.index') }}" method="GET" class="flex gap-2 mb-6">
        @if (request('category'))
            <input type="hidden" name="category" value="{{ request('category') }}">
        @endif
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by title or author"
               class="flex-1 border border-line rounded-sm px-3 py-2 bg-white">
        <button type="submit" class="bg-forest hover:bg-forest-dark text-paper px-5 py-2 rounded-sm text-sm transition">Search</button>
        @if (request('search'))
            <a href="{{ route('books.index', request()->only('category')) }}" class="text-ink-soft hover:text-ink px-3 py-2 text-sm transition">Clear</a>
        @endif
    </form>

    <div class="flex flex-wrap gap-2 mb-10">
        <a href="{{ route('books.index', request()->only('search')) }}"
           class="px-4 py-1.5 rounded-sm text-sm border transition {{ !request('category') ? 'bg-forest text-paper border-forest' : 'border-line text-ink-soft hover:border-forest' }}">
            All
        </a>
        @foreach ($categories as $category)
            <a href="{{ route('books.index', array_merge(request()->only('search'), ['category' => $category->id])) }}"
               class="px-4 py-1.5 rounded-sm text-sm border transition {{ request('category') == $category->id ? 'bg-forest text-paper border-forest' : 'border-line text-ink-soft hover:border-forest' }}">
                {{ $category->name }}
            </a>
        @endforeach
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-8">
        @forelse ($books as $book)
            @include('books._book-card', ['book' => $book])
        @empty
            <p class="text-ink-soft col-span-full">
                @if (request('search'))
                    No books match "{{ request('search') }}".
                @else
                    No books found on this shelf yet.
                @endif
            </p>
        @endforelse
    </div>

    <div class="mt-10">
        {{ $books->links() }}
    </div>
</div>
@endsection
