@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
        <a href="{{ route('dashboard.books.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">
            Add book
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-50 text-green-700 border border-green-200 rounded-lg px-4 py-3 mb-6 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-10">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
            <p class="text-sm text-gray-500 mb-1">Total books</p>
            <p class="text-2xl font-bold text-gray-800">{{ $stats['totalBooks'] }}</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
            <p class="text-sm text-gray-500 mb-1">Total authors</p>
            <p class="text-2xl font-bold text-gray-800">{{ $stats['totalAuthors'] }}</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
            <p class="text-sm text-gray-500 mb-1">Low stock (&lt; 5)</p>
            <p class="text-2xl font-bold {{ $stats['lowStockCount'] > 0 ? 'text-red-500' : 'text-gray-800' }}">
                {{ $stats['lowStockCount'] }}
            </p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
            <p class="text-sm text-gray-500 mb-1">Total catalog value</p>
            <p class="text-2xl font-bold text-gray-800">${{ number_format($stats['totalStockValue'], 2) }}</p>
        </div>
    </div>

    <h2 class="text-xl font-semibold text-gray-800 mb-4">Recently added books</h2>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-5 py-3 text-sm font-semibold text-gray-500">Title</th>
                    <th class="px-5 py-3 text-sm font-semibold text-gray-500">Author</th>
                    <th class="px-5 py-3 text-sm font-semibold text-gray-500">Price</th>
                    <th class="px-5 py-3 text-sm font-semibold text-gray-500">Stock</th>
                    <th class="px-5 py-3 text-sm font-semibold text-gray-500 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($recentBooks as $book)
                    <tr class="border-b border-gray-100 last:border-0">
                        <td class="px-5 py-3 text-gray-800">{{ $book->title }}</td>
                        <td class="px-5 py-3 text-gray-600">{{ $book->author->name }}</td>
                        <td class="px-5 py-3 text-gray-600">${{ number_format($book->price, 2) }}</td>
                        <td class="px-5 py-3 {{ $book->stock < 5 ? 'text-red-500' : 'text-gray-600' }}">
                            {{ $book->stock }}
                        </td>
                        <td class="px-5 py-3 text-right">
                            <a href="{{ route('dashboard.books.edit', $book) }}" class="text-blue-600 text-sm mr-3">Edit</a>
                            <form action="{{ route('dashboard.books.destroy', $book) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Delete this book? This cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 text-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection