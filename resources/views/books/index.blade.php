@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10">
    <div class="mb-8 pb-6 border-b border-line">
        <h1 class="font-display text-4xl font-semibold text-ink">On the shelf</h1>
        <p class="text-ink-soft mt-1">{{ $books->total() }} books, sorted by newest arrivals.</p>
    </div>

    <div class="flex flex-wrap gap-2 mb-10">
        <a href="{{ route('books.index') }}"
           class="px-4 py-1.5 rounded-sm text-sm border transition {{ !request('category') ? 'bg-forest text-paper border-forest' : 'border-line text-ink-soft hover:border-forest' }}">
            All
        </a>
        @foreach ($categories as $category)
            <a href="{{ route('books.index', ['category' => $category->id]) }}"
               class="px-4 py-1.5 rounded-sm text-sm border transition {{ request('category') == $category->id ? 'bg-forest text-paper border-forest' : 'border-line text-ink-soft hover:border-forest' }}">
                {{ $category->name }}
            </a>
        @endforeach
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-8">
        @forelse ($books as $book)
            @include('books._book-card', ['book' => $book])
        @empty
            <p class="text-ink-soft col-span-full">No books found on this shelf yet.</p>
        @endforelse
    </div>

    <div class="mt-10">
        {{ $books->links() }}
    </div>
</div>
@endsection
