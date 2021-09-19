<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Cookie;

class CartController extends Controller
{
    public function index()
    {
        $data = json_decode(Cookie::get('cart'), true);
        $products = Product::find(array_keys($data));
        $cart_quantities = array_values($data);

        return view('cart', compact('products', 'cart_quantities'));
    }

    public function add($id)
    {
        $user = auth()->user();
        if(!$user)
        {
            return redirect()->route('login');
        }

        if(!Cookie::has('cart'))
        {
            $data = [$id => 1];
            Cookie::queue('cart', json_encode($data), 60 * 24);
        }
        else
        {
            $data = Cookie::get('cart');
            $data = json_decode($data, true);

            if(isset($data->{$id}))
            {
                $data[$id] = $data[$id] + 1;
            }
            else
            {
                $data[$id] = 1;
            }
            Cookie::queue('cart', json_encode($data), 60 * 24);
        }

        return redirect()->back()->with('status', "Your product has been added to the cart!");
    }

    public function update(Request $request)
    {
        $data = $request->get('data');
        // dd($data);
        $cart = json_decode(Cookie::get('cart'), true);
        foreach($data as $key => $quantity)
        {
            $id = explode('cart-quantity-product-', $key)[1];
            if($quantity > 0)
            {
                $cart[$id] = $quantity;
            }
            else
            {
                unset($cart[$id]);
            }
        }

        Cookie::queue('cart', json_encode($cart), 60 * 24);

        return redirect()->back()->with('status', "Cart updated!");
    }
}
