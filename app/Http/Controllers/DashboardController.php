<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'totalBooks' => Book::count(),
            'totalAuthors' => Author::count(),
            'lowStockCount' => Book::where('stock', '<', 5)->count(),
            'totalStockValue' => Book::sum('price'),
        ];

        $recentBooks = Book::with('author')->latest()->take(5)->get();

        return view('dashboard.index', compact('stats', 'recentBooks'));
    }
}