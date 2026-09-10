@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    <div class="flex items-center justify-between mb-8 pb-6 border-b border-line">
        <div>
            <h1 class="font-display text-3xl font-semibold text-ink">Authors</h1>
            <p class="text-ink-soft mt-1">{{ $authors->total() }} authors on file.</p>
        </div>
        <a href="{{ route('dashboard.authors.create') }}" class="bg-forest hover:bg-forest-dark text-paper px-4 py-2 rounded-sm text-sm transition">
            Add author
        </a>
    </div>

    @if (session('success'))
        <div class="bg-forest/10 text-forest border border-forest/30 rounded-sm px-4 py-3 mb-6 text-sm">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-clay/10 text-clay border border-clay/30 rounded-sm px-4 py-3 mb-6 text-sm">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('dashboard.authors.index') }}" method="GET" class="flex gap-2 mb-6">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search authors"
               class="flex-1 border border-line rounded-sm px-3 py-2 bg-white">
        <button type="submit" class="bg-forest hover:bg-forest-dark text-paper px-5 py-2 rounded-sm text-sm transition">Search</button>
        @if (request('search'))
            <a href="{{ route('dashboard.authors.index') }}" class="text-ink-soft hover:text-ink px-3 py-2 text-sm transition">Clear</a>
        @endif
    </form>

    <div class="bg-paper border border-line overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-forest/5 border-b border-line">
                <tr>
                    <th class="px-5 py-3 text-sm font-semibold text-ink-soft">Name</th>
                    <th class="px-5 py-3 text-sm font-semibold text-ink-soft">Books</th>
                    <th class="px-5 py-3 text-sm font-semibold text-ink-soft text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($authors as $author)
                    <tr class="border-b border-line last:border-0">
                        <td class="px-5 py-3 text-ink">{{ $author->name }}</td>
                        <td class="px-5 py-3 text-ink-soft">{{ $author->books_count }}</td>
                        <td class="px-5 py-3 text-right">
                            <a href="{{ route('dashboard.authors.edit', $author) }}" class="text-forest hover:text-brass text-sm mr-3 transition">Edit</a>
                            <form action="{{ route('dashboard.authors.destroy', $author) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Delete this author?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-clay hover:text-clay/70 text-sm transition">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-5 py-6 text-ink-soft text-center">No authors found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $authors->links() }}
    </div>
</div>
@endsection
