@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-10">
    <h1 class="font-display text-2xl font-semibold text-ink mb-6">Add an author</h1>

    <form action="{{ route('dashboard.authors.store') }}" method="POST" class="bg-paper border border-line p-6 space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-medium text-ink-soft mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name') }}"
                   class="w-full border border-line rounded-sm px-3 py-2 bg-white">
            @error('name') <p class="text-sm text-clay mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-ink-soft mb-1">Bio</label>
            <textarea name="bio" rows="4" class="w-full border border-line rounded-sm px-3 py-2 bg-white">{{ old('bio') }}</textarea>
            @error('bio') <p class="text-sm text-clay mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-end gap-3 pt-2">
            <a href="{{ route('dashboard.authors.index') }}" class="px-4 py-2 text-ink-soft hover:text-ink transition">Cancel</a>
            <button type="submit" class="bg-forest hover:bg-forest-dark text-paper px-5 py-2 rounded-sm transition">Save author</button>
        </div>
    </form>
</div>
@endsection
