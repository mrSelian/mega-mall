<?php

namespace App\Http\Controllers;


use App\Cart;
use App\Models\Product;
use Illuminate\Http\Request;


class CartController extends Controller
{
    public function index(Request $request)
    {

        if ($request->session()->has('cart')) {
            $cart = ($request->session()->get('cart'));
            $totalPrice = $cart->calcTotalPrice();
        } else {
            $cart = new Cart($request);
            $totalPrice = $cart->calcTotalPrice();
        }

        return view('cart', compact('totalPrice'));
    }


    public function addProduct(Request $request)
    {
        $productRec = Product::where('id', $request->id)->firstOrFail();

        if ($request->session()->has('cart')) {
            $cart = ($request->session()->get('cart'));
        } else {
            $cart = new Cart($request);
        }
        $product = new \App\Product($productRec);

        $cart->addToCart($product);

        return redirect('cart');
    }


    public function removeProduct(Request $request)
    {

        $cart = $request->session()->get('cart');
        $cart->removeFromCart($request->id);

        return redirect()->back();
    }

    public function clearCart(Request $request)
    {
        $cart = $request->session()->get('cart');

        $cart->clear();

        return redirect()->back();
    }

    public function actualize(Request $request)
    {
        $cart = $request->session()->get('cart');
        $cart->actualize();
        return redirect()->back();
    }

    public function toOrder(Request $request)
    {
        $cart = $request->session()->get('cart');
        $cart->actualize();
        $cart->toOrder();
    }

}
