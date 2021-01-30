<?php

namespace App\Http\Controllers;


use App\Cart;
use App\Models\Product;
use Illuminate\Http\Request;


class CartController extends Controller
{
    public function index()
    {
        $cart = new Cart();
        $totalPrice = $cart->calcTotalPrice();

        return view('cart', compact('totalPrice'));
    }


    public function addProduct(Request $request)
    {
        $productRec = Product::where('id', $request->id)->firstOrFail();

        $cart = new Cart();

        $cart->addToCart($productRec);

        return view('cart');
    }


    public function removeProduct(Request $request)
    {
        $productRec = Product::where('id', $request->id)->firstOrFail();

        $cart = new Cart();

        $cart->removeFromCart($productRec);

        return view('cart');
    }

    public function clearCart()
    {
        $cart = new Cart();

        $cart->clear();

        return view('cart');
    }

}
