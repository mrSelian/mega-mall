<?php

namespace App;


use App\Domain\Cart;
use App\Domain\CartProduct;
use App\Domain\CartRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class SessionCartRepository implements CartRepositoryInterface
{

    public function get(): Cart
    {
        if (session()->has('cart')) {
            $cart = (session()->get('cart'));
            $cart['products'] = array_map(fn(array $product) => new CartProduct($product['id'],$product['name'],$product['price'],$product['amount']), $cart['products']);
        } else {
            $cart = ['customerId' => Auth::id(),
                'products' => []];
        }
        return new Cart($cart['customerId'], $cart['products']);
    }

    public function save(array $cart)
    {
        session()->put('cart', $cart);
    }

}
