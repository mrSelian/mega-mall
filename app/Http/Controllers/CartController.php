<?php

namespace App\Http\Controllers;


use App\Cart;
use App\Models\Product;
use Illuminate\Http\Request;


class CartController extends Controller
{
    public function index(Request $request)
    {
        $cart = new Cart($request);
        $totalPrice = $cart->calcTotalPrice();

        return view('cart', compact('totalPrice'));
    }


    public function addProduct(Request $request)
    {
        $productRec = Product::where('id', $request->id)->firstOrFail();

        $cart = new Cart($request);

        $product = new \App\Product($productRec);

        $cart->addToCart($product);

        return redirect('/cart');
    }


    public function removeProduct(Request $request)
    {
        $cart = new Cart($request);

        $cart->removeFromCart($request->id);

        return redirect('/cart');
    }

    public function clearCart(Request $request)
    {
        $cart = new Cart($request);

        $cart->clear();

        return redirect('/cart');
    }

}
