<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $uid = auth()->user()->id;

        $orders = Order::with('items.product')
            ->where('user_id', $uid)
            ->get();

        return view('orders', compact('orders'));
    }
}
