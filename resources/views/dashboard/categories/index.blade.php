@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-10">
    <div class="flex items-center justify-between mb-8 pb-6 border-b border-line">
        <div>
            <h1 class="font-display text-3xl font-semibold text-ink">Categories</h1>
            <p class="text-ink-soft mt-1">{{ $categories->count() }} categories.</p>
        </div>
        <a href="{{ route('dashboard.categories.create') }}" class="bg-forest hover:bg-forest-dark text-paper px-4 py-2 rounded-sm text-sm transition">
            Add category
        </a>
    </div>

    @if (session('success'))
        <div class="bg-forest/10 text-forest border border-forest/30 rounded-sm px-4 py-3 mb-6 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-paper border border-line overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-forest/5 border-b border-line">
                <tr>
                    <th class="px-5 py-3 text-sm font-semibold text-ink-soft">Name</th>
                    <th class="px-5 py-3 text-sm font-semibold text-ink-soft">Books tagged</th>
                    <th class="px-5 py-3 text-sm font-semibold text-ink-soft text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr class="border-b border-line last:border-0">
                        <td class="px-5 py-3 text-ink">{{ $category->name }}</td>
                        <td class="px-5 py-3 text-ink-soft">{{ $category->books_count }}</td>
                        <td class="px-5 py-3 text-right">
                            <a href="{{ route('dashboard.categories.edit', $category) }}" class="text-forest hover:text-brass text-sm mr-3 transition">Edit</a>
                            <form action="{{ route('dashboard.categories.destroy', $category) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Delete this category? It will be removed from any tagged books.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-clay hover:text-clay/70 text-sm transition">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-5 py-6 text-ink-soft text-center">No categories yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
