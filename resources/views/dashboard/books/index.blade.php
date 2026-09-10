@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10">
    <div class="flex items-center justify-between mb-8 pb-6 border-b border-line">
        <div>
            <h1 class="font-display text-3xl font-semibold text-ink">Manage books</h1>
            <p class="text-ink-soft mt-1">{{ $books->total() }} books in the catalog.</p>
        </div>
        <a href="{{ route('dashboard.books.create') }}" class="bg-forest hover:bg-forest-dark text-paper px-4 py-2 rounded-sm text-sm transition">
            Add book
        </a>
    </div>

    @if (session('success'))
        <div class="bg-forest/10 text-forest border border-forest/30 rounded-sm px-4 py-3 mb-6 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('dashboard.books.index') }}" method="GET" class="flex gap-2 mb-6">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by title or author"
               class="flex-1 border border-line rounded-sm px-3 py-2 bg-white">
        <button type="submit" class="bg-forest hover:bg-forest-dark text-paper px-5 py-2 rounded-sm text-sm transition">Search</button>
        @if (request('search'))
            <a href="{{ route('dashboard.books.index') }}" class="text-ink-soft hover:text-ink px-3 py-2 text-sm transition">Clear</a>
        @endif
    </form>

    <div class="bg-paper border border-line overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-forest/5 border-b border-line">
                <tr>
                    <th class="px-5 py-3 text-sm font-semibold text-ink-soft"></th>
                    <th class="px-5 py-3 text-sm font-semibold text-ink-soft">Title</th>
                    <th class="px-5 py-3 text-sm font-semibold text-ink-soft">Author</th>
                    <th class="px-5 py-3 text-sm font-semibold text-ink-soft">Price</th>
                    <th class="px-5 py-3 text-sm font-semibold text-ink-soft">Stock</th>
                    <th class="px-5 py-3 text-sm font-semibold text-ink-soft text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($books as $book)
                    <tr class="border-b border-line last:border-0">
                        <td class="px-5 py-3">
                            @if ($book->cover_image)
                                <img src="{{ $book->coverUrl() }}" alt="{{ $book->title }}" class="w-8 aspect-[2/3] object-cover border border-line">
                            @else
                                <div class="w-8 aspect-[2/3] bg-forest/5 border border-line flex items-center justify-center">
                                    <span class="font-display text-xs text-brass">{{ substr($book->title, 0, 1) }}</span>
                                </div>
                            @endif
                        </td>
                        <td class="px-5 py-3 text-ink">{{ $book->title }}</td>
                        <td class="px-5 py-3 text-ink-soft">{{ $book->author->name }}</td>
                        <td class="px-5 py-3 text-ink-soft">${{ number_format($book->price, 2) }}</td>
                        <td class="px-5 py-3 {{ $book->stock < 5 ? 'text-clay' : 'text-ink-soft' }}">
                            {{ $book->stock }}
                        </td>
                        <td class="px-5 py-3 text-right">
                            <a href="{{ route('dashboard.books.edit', $book) }}" class="text-forest hover:text-brass text-sm mr-3 transition">Edit</a>
                            <form action="{{ route('dashboard.books.destroy', $book) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Delete this book? This cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-clay hover:text-clay/70 text-sm transition">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-5 py-6 text-ink-soft text-center">
                            @if (request('search'))
                                No books match "{{ request('search') }}".
                            @else
                                No books yet.
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $books->links() }}
    </div>
</div>
@endsection
