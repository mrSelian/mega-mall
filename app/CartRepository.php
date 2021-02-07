<?php


namespace App;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartRepository implements CartRepositoryInterface
{

    public function get($source): Cart
    {
        return $this->fromSession($source);

    }

    public function save(Cart $cart)
    {
        $this->toSession($cart);
    }

    private function toSession(Cart $cart)
    {
        Session::put('cart', $cart);
    }

    private function fromSession(Request $request): Cart
    {
        if ($request->session()->has('cart')) {
            $cart = ($request->session()->get('cart'));
        } else {
            $cart = new Cart($this);
        }
        return $cart;
    }

}
