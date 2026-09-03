<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardBookController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
Route::get('/dashboard/books/create', [DashboardBookController::class, 'create'])->name('dashboard.books.create');
Route::post('/dashboard/books', [DashboardBookController::class, 'store'])->name('dashboard.books.store');
Route::get('/dashboard/books/{book}/edit', [DashboardBookController::class, 'edit'])->name('dashboard.books.edit');
Route::put('/dashboard/books/{book}', [DashboardBookController::class, 'update'])->name('dashboard.books.update');
Route::delete('/dashboard/books/{book}', [DashboardBookController::class, 'destroy'])->name('dashboard.books.destroy');