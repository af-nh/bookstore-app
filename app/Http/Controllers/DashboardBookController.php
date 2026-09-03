<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardBookController extends Controller
{
    public function create(): View
    {
        $authors = Author::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();

        return view('dashboard.books.create', compact('authors', 'categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateBook($request);

        $book = Book::create($validated);
        $book->categories()->sync($request->input('categories', []));

        return redirect()->route('dashboard.index')->with('success', 'Book created successfully.');
    }

    public function edit(Book $book): View
    {
        $authors = Author::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();
        $book->load('categories');

        return view('dashboard.books.edit', compact('book', 'authors', 'categories'));
    }

    public function update(Request $request, Book $book): RedirectResponse
    {
        $validated = $this->validateBook($request);

        $book->update($validated);
        $book->categories()->sync($request->input('categories', []));

        return redirect()->route('dashboard.index')->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book): RedirectResponse
    {
        $book->delete();

        return redirect()->route('dashboard.index')->with('success', 'Book deleted successfully.');
    }

    private function validateBook(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
        ]);
    }
}