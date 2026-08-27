<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

Route::get('/', function () {
    return view('welcome');
});

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