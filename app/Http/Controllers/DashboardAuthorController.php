<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardAuthorController extends Controller
{
    public function index(Request $request): View
    {
        $authors = Author::withCount('books')
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        return view('dashboard.authors.index', compact('authors'));
    }

    public function create(): View
    {
        return view('dashboard.authors.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateAuthor($request);

        Author::create($validated);

        return redirect()->route('dashboard.authors.index')->with('success', 'Author added successfully.');
    }

    public function edit(Author $author): View
    {
        return view('dashboard.authors.edit', compact('author'));
    }

    public function update(Request $request, Author $author): RedirectResponse
    {
        $validated = $this->validateAuthor($request);

        $author->update($validated);

        return redirect()->route('dashboard.authors.index')->with('success', 'Author updated successfully.');
    }

    public function destroy(Author $author): RedirectResponse
    {
        if ($author->books()->exists()) {
            return back()->with('error', 'Cannot delete "' . $author->name . '" — they still have books in the catalog. Delete or reassign those books first.');
        }

        $author->delete();

        return redirect()->route('dashboard.authors.index')->with('success', 'Author deleted successfully.');
    }

    private function validateAuthor(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
        ]);
    }
}
