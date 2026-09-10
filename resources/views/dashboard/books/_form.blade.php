@php $book = $book ?? null; @endphp

<div>
    <label class="block text-sm font-medium text-ink-soft mb-1">Cover image</label>
    @if ($book?->cover_image)
        <img src="{{ $book->coverUrl() }}" alt="{{ $book->title }}" class="w-24 h-32 object-cover border border-line rounded-sm mb-2">
    @endif
    <input type="file" name="cover_image" accept="image/*" class="w-full text-sm text-ink-soft">
    @if ($book)
        <p class="text-xs text-ink-soft mt-1">Leave blank to keep the current image.</p>
    @endif
    @error('cover_image') <p class="text-sm text-clay mt-1">{{ $message }}</p> @enderror
</div>

<div>
    <label class="block text-sm font-medium text-ink-soft mb-1">Title</label>
    <input type="text" name="title" value="{{ old('title', $book->title ?? '') }}"
           class="w-full border border-line rounded-sm px-3 py-2 bg-white">
    @error('title') <p class="text-sm text-clay mt-1">{{ $message }}</p> @enderror
</div>

<div>
    <label class="block text-sm font-medium text-ink-soft mb-1">Author</label>
    <select name="author_id" class="w-full border border-line rounded-sm px-3 py-2 bg-white">
        <option value="">Select an author</option>
        @foreach ($authors as $author)
            <option value="{{ $author->id }}" {{ old('author_id', $book->author_id ?? '') == $author->id ? 'selected' : '' }}>
                {{ $author->name }}
            </option>
        @endforeach
    </select>
    @error('author_id') <p class="text-sm text-clay mt-1">{{ $message }}</p> @enderror
</div>

<div>
    <label class="block text-sm font-medium text-ink-soft mb-1">Description</label>
    <textarea name="description" rows="4" class="w-full border border-line rounded-sm px-3 py-2 bg-white">{{ old('description', $book->description ?? '') }}</textarea>
    @error('description') <p class="text-sm text-clay mt-1">{{ $message }}</p> @enderror
</div>

<div class="grid grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium text-ink-soft mb-1">Price</label>
        <input type="number" step="0.01" name="price" value="{{ old('price', $book->price ?? '') }}"
               class="w-full border border-line rounded-sm px-3 py-2 bg-white">
        @error('price') <p class="text-sm text-clay mt-1">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="block text-sm font-medium text-ink-soft mb-1">Stock</label>
        <input type="number" name="stock" value="{{ old('stock', $book->stock ?? '') }}"
               class="w-full border border-line rounded-sm px-3 py-2 bg-white">
        @error('stock') <p class="text-sm text-clay mt-1">{{ $message }}</p> @enderror
    </div>
</div>

<div>
    <label class="block text-sm font-medium text-ink-soft mb-2">Categories</label>
    <div class="flex flex-wrap gap-3">
        @php $selectedCategories = old('categories', $book?->categories->pluck('id')->toArray() ?? []); @endphp
        @foreach ($categories as $category)
            <label class="flex items-center gap-2 text-sm text-ink">
                <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                       {{ in_array($category->id, $selectedCategories) ? 'checked' : '' }}>
                {{ $category->name }}
            </label>
        @endforeach
    </div>
</div>
