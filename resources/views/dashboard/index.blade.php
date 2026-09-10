@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10">
    <div class="flex items-center justify-between mb-8 pb-6 border-b border-line">
        <h1 class="font-display text-3xl font-semibold text-ink">Dashboard</h1>
        <a href="{{ route('dashboard.books.create') }}" class="bg-forest hover:bg-forest-dark text-paper px-4 py-2 rounded-sm text-sm transition">
            Add book
        </a>
    </div>

    <div class="flex flex-wrap gap-2 mb-8">
        <a href="{{ route('dashboard.books.index') }}" class="px-4 py-1.5 rounded-sm text-sm border border-line text-ink-soft hover:border-forest hover:text-ink transition">Manage books</a>
        <a href="{{ route('dashboard.authors.index') }}" class="px-4 py-1.5 rounded-sm text-sm border border-line text-ink-soft hover:border-forest hover:text-ink transition">Manage authors</a>
        <a href="{{ route('dashboard.categories.index') }}" class="px-4 py-1.5 rounded-sm text-sm border border-line text-ink-soft hover:border-forest hover:text-ink transition">Manage categories</a>
        <a href="{{ route('dashboard.orders.index') }}" class="px-4 py-1.5 rounded-sm text-sm border border-line text-ink-soft hover:border-forest hover:text-ink transition">View all orders</a>
    </div>

    @if (session('success'))
        <div class="bg-forest/10 text-forest border border-forest/30 rounded-sm px-4 py-3 mb-6 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-10">
        <div class="bg-paper border border-line border-l-4 border-l-brass p-5">
            <p class="text-sm text-ink-soft mb-1">Total books</p>
            <p class="font-display text-2xl font-semibold text-ink">{{ $stats['totalBooks'] }}</p>
        </div>

        <a href="{{ route('dashboard.authors.index') }}" class="bg-paper border border-line border-l-4 border-l-brass p-5 hover:border-l-forest transition">
            <p class="text-sm text-ink-soft mb-1">Total authors</p>
            <p class="font-display text-2xl font-semibold text-ink">{{ $stats['totalAuthors'] }}</p>
        </a>

        <div class="bg-paper border border-line border-l-4 {{ $stats['lowStockCount'] > 0 ? 'border-l-clay' : 'border-l-brass' }} p-5">
            <p class="text-sm text-ink-soft mb-1">Low stock (&lt; 5)</p>
            <p class="font-display text-2xl font-semibold {{ $stats['lowStockCount'] > 0 ? 'text-clay' : 'text-ink' }}">
                {{ $stats['lowStockCount'] }}
            </p>
        </div>

        <div class="bg-paper border border-line border-l-4 border-l-brass p-5">
            <p class="text-sm text-ink-soft mb-1">Total catalog value</p>
            <p class="font-display text-2xl font-semibold text-ink">${{ number_format($stats['totalStockValue'], 2) }}</p>
        </div>

        <a href="{{ route('dashboard.orders.index') }}" class="bg-paper border border-line border-l-4 border-l-brass p-5 hover:border-l-forest transition">
            <p class="text-sm text-ink-soft mb-1">Orders placed</p>
            <p class="font-display text-2xl font-semibold text-ink">{{ $stats['totalOrders'] }}</p>
        </a>

        <a href="{{ route('dashboard.orders.index') }}" class="bg-paper border border-line border-l-4 border-l-brass p-5 hover:border-l-forest transition">
            <p class="text-sm text-ink-soft mb-1">Total revenue</p>
            <p class="font-display text-2xl font-semibold text-ink">${{ number_format($stats['totalRevenue'], 2) }}</p>
        </a>
    </div>

    <div class="flex items-center justify-between mb-4">
        <h2 class="font-display text-xl font-semibold text-ink">Recently added books</h2>
        <a href="{{ route('dashboard.books.index') }}" class="text-sm text-forest hover:text-brass transition">Manage all books &rarr;</a>
    </div>

    <div class="bg-paper border border-line overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-forest/5 border-b border-line">
                <tr>
                    <th class="px-5 py-3 text-sm font-semibold text-ink-soft">Title</th>
                    <th class="px-5 py-3 text-sm font-semibold text-ink-soft">Author</th>
                    <th class="px-5 py-3 text-sm font-semibold text-ink-soft">Price</th>
                    <th class="px-5 py-3 text-sm font-semibold text-ink-soft">Stock</th>
                    <th class="px-5 py-3 text-sm font-semibold text-ink-soft text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($recentBooks as $book)
                    <tr class="border-b border-line last:border-0">
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
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
