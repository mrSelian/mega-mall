<?php


namespace App;


use Illuminate\Support\Facades\Session;

class SessionCartRepository implements CartRepositoryInterface
{

    public function get(): Cart
    {
        if (session()->has('cart')) {
            $cart = (session()->get('cart'));
        } else {
            $cart = new Cart($this);
        }
        return $cart;
    }

    public function save(Cart $cart)
    {
        Session::put('cart', $cart);
    }

}
