<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $cart = session('cart', []);
        $books = Book::whereIn('id', array_keys($cart))->get();

        $items = $books->map(function (Book $book) use ($cart) {
            return [
                'book' => $book,
                'quantity' => $cart[$book->id],
                'subtotal' => $book->price * $cart[$book->id],
            ];
        });

        $total = $items->sum('subtotal');

        return view('cart.index', compact('items', 'total'));
    }

    public function add(Request $request, Book $book): RedirectResponse
    {
        $request->validate([
            'quantity' => 'nullable|integer|min:1',
        ]);

        $quantity = $request->input('quantity', 1);
        $cart = session('cart', []);

        $currentQty = $cart[$book->id] ?? 0;

        if ($currentQty + $quantity > $book->stock) {
            return back()->with('error', 'Not enough stock available for "' . $book->title . '".');
        }

        $cart[$book->id] = $currentQty + $quantity;
        session(['cart' => $cart]);

        return back()->with('success', $book->title . ' added to cart.');
    }

    public function update(Request $request, Book $book): RedirectResponse
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        if ($request->quantity > $book->stock) {
            return back()->with('error', 'Only ' . $book->stock . ' in stock for "' . $book->title . '".');
        }

        $cart = session('cart', []);
        $cart[$book->id] = $request->quantity;
        session(['cart' => $cart]);

        return back()->with('success', 'Cart updated.');
    }

    public function remove(Book $book): RedirectResponse
    {
        $cart = session('cart', []);
        unset($cart[$book->id]);
        session(['cart' => $cart]);

        return back()->with('success', $book->title . ' removed from cart.');
    }

    public function checkout(Request $request): RedirectResponse
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Your cart is empty.');
        }

        $books = Book::whereIn('id', array_keys($cart))->get();

        foreach ($books as $book) {
            if ($cart[$book->id] > $book->stock) {
                return back()->with('error', 'Not enough stock for "' . $book->title . '". Someone may have bought it first.');
            }
        }

        $order = DB::transaction(function () use ($books, $cart, $request) {
            $order = Order::create([
                'user_id' => $request->user()->id,
                'total' => $books->sum(fn (Book $book) => $book->price * $cart[$book->id]),
            ]);

            foreach ($books as $book) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'book_id' => $book->id,
                    'quantity' => $cart[$book->id],
                    'price' => $book->price,
                ]);

                $book->decrement('stock', $cart[$book->id]);
            }

            return $order;
        });

        session()->forget('cart');

        return redirect()->route('books.index')->with('success', 'Order #' . $order->id . ' placed! Thanks for your purchase.');
    }
}
