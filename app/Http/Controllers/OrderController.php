<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    public function show(Request $request, Order $order): View
    {
        if ($order->user_id !== $request->user()->id && $request->user()->role !== 'admin') {
            abort(Response::HTTP_FORBIDDEN, 'You do not have access to this order.');
        }

        $order->load('items.book', 'user');

        return view('orders.show', compact('order'));
    }
}
