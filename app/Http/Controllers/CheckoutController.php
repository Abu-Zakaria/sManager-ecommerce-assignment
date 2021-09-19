<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cookie;
use App\Models\Product;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Http\Requests\CheckoutRequest;

class CheckoutController extends Controller
{
    public function index()
    {
        $data = json_decode(Cookie::get('cart'), true);

        $cart = [];
        foreach($data as $key => $value)
        {
            $product = Product::find($key);
            $quantity = $value;
            $cart[] = [
                'product' => $product,
                'quantity' => $quantity,
            ];
        }
        return view('checkout');
    }

    public function store(CheckoutRequest $request)
    {
        $data = $request->validated();

        if($data['payment_method'] == 'online_payment')
        {
            return redirect()->back()->with('status', "Not implemented yet!");
        }
        else
        {
            $district = $data['district'];
            $division = $data['division'];
            $address = $data['address'];

            $uid = auth()->user()->id;
            Address::create([
                'user_id' => $uid,
                'district' => $district,
                'division' => $division,
                'address' => $address,
            ]);

            $cart = json_decode(Cookie::get('cart'), true);
            $products = [];
            $quantities = [];
            $sub_total = 0;

            foreach($cart as $key => $value)
            {
                $products[] = $p = Product::find($key);
                $sub_total += $p->price * $value;
                $quantities[] = $value;
            }

            $order = Order::create([
                'user_id' => $uid,
                'sub_total' => $sub_total,
                'status' => 'ordered'
            ]);

            foreach ($products as $key => $product)
            {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $quantities[$key],
                ]);
            }

            Cookie::queue('cart', json_encode([]), 1);

            return redirect()->to('/')->with('status', 'Successfully placed your order!');
        }
    }
}
