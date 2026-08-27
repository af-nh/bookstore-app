<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public function show($id)
{
    return "Book ID: " . $id;
}
    public function index()
    {

        $books = [
            [
                'id' => 1,
                'title' => 'Clean Code',
                'author' => 'Robert',
                'price' => 30,
            ],
            [
                'id' => 2,
                'title' => 'Prog',
                'author' => 'andrew',
                'price' => 35,
            ],
            [
                'id' => 3,
                'title' => 'Design Patterns',
                'author' => 'Erich Gamma',
                'price' => 40
            ]
        ];
        
        return view('books.index', compact('books'));
    }
}
