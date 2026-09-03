<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

Route::get('/', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{id}', [BookController::class, 'show'])->where('id', '[0-9]+');
Route::get('/welcome/{name?}', function ($name = "Guest") {
    return "Welcome " . $name . " to our BookStore!";
});

Route::post('/books', function () {
    return "Book created";
});

Route::put('/books/{id}', function ($id) {
    return "Book " . $id . " updated";
});

Route::delete('/books/{id}', function ($id) {
    return "Book " . $id . " deleted";
});
