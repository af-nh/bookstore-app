@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit book</h1>

    <form action="{{ route('dashboard.books.update', $book) }}" method="POST" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
            <input type="text" name="title" value="{{ old('title', $book->title) }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2">
            @error('title') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Author</label>
            <select name="author_id" class="w-full border border-gray-300 rounded-lg px-3 py-2">
                <option value="">Select an author</option>
                @foreach ($authors as $author)
                    <option value="{{ $author->id }}" {{ old('author_id', $book->author_id) == $author->id ? 'selected' : '' }}>
                        {{ $author->name }}
                    </option>
                @endforeach
            </select>
            @error('author_id') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea name="description" rows="4" class="w-full border border-gray-300 rounded-lg px-3 py-2">{{ old('description', $book->description) }}</textarea>
            @error('description') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Price</label>
                <input type="number" step="0.01" name="price" value="{{ old('price', $book->price) }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2">
                @error('price') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Stock</label>
                <input type="number" name="stock" value="{{ old('stock', $book->stock) }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2">
                @error('stock') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Categories</label>
            <div class="flex flex-wrap gap-3">
                @php $selectedCategories = old('categories', $book->categories->pluck('id')->toArray()); @endphp
                @foreach ($categories as $category)
                    <label class="flex items-center gap-2 text-sm text-gray-700">
                        <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                               {{ in_array($category->id, $selectedCategories) ? 'checked' : '' }}>
                        {{ $category->name }}
                    </label>
                @endforeach
            </div>
        </div>

        <div class="flex justify-end gap-3 pt-2">
            <a href="{{ route('dashboard.index') }}" class="px-4 py-2 text-gray-600">Cancel</a>
            <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-lg">Update book</button>
        </div>
    </form>
</div>
@endsection