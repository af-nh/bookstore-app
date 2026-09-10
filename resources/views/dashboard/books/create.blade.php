@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-10">
    <h1 class="font-display text-2xl font-semibold text-ink mb-6">Add a new book</h1>

    <form action="{{ route('dashboard.books.store') }}" method="POST" enctype="multipart/form-data" class="bg-paper border border-line p-6 space-y-5">
        @csrf

        @include('dashboard.books._form', ['authors' => $authors, 'categories' => $categories])

        <div class="flex justify-end gap-3 pt-2">
            <a href="{{ route('dashboard.books.index') }}" class="px-4 py-2 text-ink-soft hover:text-ink transition">Cancel</a>
            <button type="submit" class="bg-forest hover:bg-forest-dark text-paper px-5 py-2 rounded-sm transition">Save book</button>
        </div>
    </form>
</div>
@endsection
