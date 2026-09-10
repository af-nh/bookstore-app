<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardCategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::withCount('books')->orderBy('name')->get();

        return view('dashboard.categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('dashboard.categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateCategory($request);

        Category::create($validated);

        return redirect()->route('dashboard.categories.index')->with('success', 'Category added successfully.');
    }

    public function edit(Category $category): View
    {
        return view('dashboard.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $validated = $this->validateCategory($request, $category);

        $category->update($validated);

        return redirect()->route('dashboard.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->books()->detach();
        $category->delete();

        return redirect()->route('dashboard.categories.index')->with('success', 'Category deleted successfully.');
    }

    private function validateCategory(Request $request, ?Category $category = null): array
    {
        return $request->validate([
            'name' => 'required|string|max:255|unique:categories,name' . ($category ? ',' . $category->id : ''),
        ]);
    }
}
