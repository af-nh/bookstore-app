<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardBookController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Public book pages
Route::get('/', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');

// Auth
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Cart - browsing/editing is open to guests; checkout requires login (order history needs a user)
// IMPORTANT: /cart/checkout must stay before /cart/{book}, or the wildcard route swallows it.
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout')->middleware('auth');
Route::post('/cart/{book}', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/{book}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{book}', [CartController::class, 'remove'])->name('cart.remove');

// Personal account dashboard - any logged-in user
Route::get('/account', [AccountController::class, 'index'])->name('account.index')->middleware('auth');

// Admin dashboard - protected
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard/books/create', [DashboardBookController::class, 'create'])->name('dashboard.books.create');
    Route::post('/dashboard/books', [DashboardBookController::class, 'store'])->name('dashboard.books.store');
    Route::get('/dashboard/books/{book}/edit', [DashboardBookController::class, 'edit'])->name('dashboard.books.edit');
    Route::put('/dashboard/books/{book}', [DashboardBookController::class, 'update'])->name('dashboard.books.update');
    Route::delete('/dashboard/books/{book}', [DashboardBookController::class, 'destroy'])->name('dashboard.books.destroy');
});
