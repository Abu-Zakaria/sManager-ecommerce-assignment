<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cookie;

class CartController extends Controller
{
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
            $data = json_decode($data);

            if(isset($data->{$id}))
            {
                $data->{$id} = $data->{$id} + 1;
            }
            else
            {
                $data->{$id} = 1;
            }
            Cookie::queue('cart', json_encode($data), 60 * 24);
        }

        return redirect()->back()->with('status', "Your product has been added to the cart!");
    }
}
