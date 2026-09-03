<?php

use App\Http\Controllers\DashboardBookController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

Route::get('/', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');

Route::get('/dashboard/books/create', [DashboardBookController::class, 'create'])->name('dashboard.books.create');
Route::post('/dashboard/books', [DashboardBookController::class, 'store'])->name('dashboard.books.store');
Route::get('/dashboard/books/{book}/edit', [DashboardBookController::class, 'edit'])->name('dashboard.books.edit');
Route::put('/dashboard/books/{book}', [DashboardBookController::class, 'update'])->name('dashboard.books.update');
Route::delete('/dashboard/books/{book}', [DashboardBookController::class, 'destroy'])->name('dashboard.books.destroy');
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
