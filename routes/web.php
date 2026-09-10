<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardAuthorController;
use App\Http\Controllers\DashboardBookController;
use App\Http\Controllers\DashboardCategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardOrderController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

// Public book pages
Route::get('/', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');

// Auth
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:10,1');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Password reset
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

// Cart - browsing/editing is open to guests; checkout requires login (order history needs a user)
// IMPORTANT: /cart/checkout must stay before /cart/{book}, or the wildcard route swallows it.
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout')->middleware('auth');
Route::post('/cart/{book}', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/{book}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{book}', [CartController::class, 'remove'])->name('cart.remove');

// Personal account dashboard and order confirmation - any logged-in user
Route::middleware('auth')->group(function () {
    Route::get('/account', [AccountController::class, 'index'])->name('account.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
});

// Admin dashboard - protected
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard/orders', [DashboardOrderController::class, 'index'])->name('dashboard.orders.index');

    Route::get('/dashboard/books', [DashboardBookController::class, 'index'])->name('dashboard.books.index');
    Route::get('/dashboard/books/create', [DashboardBookController::class, 'create'])->name('dashboard.books.create');
    Route::post('/dashboard/books', [DashboardBookController::class, 'store'])->name('dashboard.books.store');
    Route::get('/dashboard/books/{book}/edit', [DashboardBookController::class, 'edit'])->name('dashboard.books.edit');
    Route::put('/dashboard/books/{book}', [DashboardBookController::class, 'update'])->name('dashboard.books.update');
    Route::delete('/dashboard/books/{book}', [DashboardBookController::class, 'destroy'])->name('dashboard.books.destroy');

    Route::get('/dashboard/authors', [DashboardAuthorController::class, 'index'])->name('dashboard.authors.index');
    Route::get('/dashboard/authors/create', [DashboardAuthorController::class, 'create'])->name('dashboard.authors.create');
    Route::post('/dashboard/authors', [DashboardAuthorController::class, 'store'])->name('dashboard.authors.store');
    Route::get('/dashboard/authors/{author}/edit', [DashboardAuthorController::class, 'edit'])->name('dashboard.authors.edit');
    Route::put('/dashboard/authors/{author}', [DashboardAuthorController::class, 'update'])->name('dashboard.authors.update');
    Route::delete('/dashboard/authors/{author}', [DashboardAuthorController::class, 'destroy'])->name('dashboard.authors.destroy');

    Route::get('/dashboard/categories', [DashboardCategoryController::class, 'index'])->name('dashboard.categories.index');
    Route::get('/dashboard/categories/create', [DashboardCategoryController::class, 'create'])->name('dashboard.categories.create');
    Route::post('/dashboard/categories', [DashboardCategoryController::class, 'store'])->name('dashboard.categories.store');
    Route::get('/dashboard/categories/{category}/edit', [DashboardCategoryController::class, 'edit'])->name('dashboard.categories.edit');
    Route::put('/dashboard/categories/{category}', [DashboardCategoryController::class, 'update'])->name('dashboard.categories.update');
    Route::delete('/dashboard/categories/{category}', [DashboardCategoryController::class, 'destroy'])->name('dashboard.categories.destroy');
});
