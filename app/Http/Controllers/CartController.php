<?php

namespace App\Http\Controllers;


use App\Models\Product;
use Illuminate\Http\Request;


class CartController extends Controller
{
    public function index()
    {
        return view('cart');
    }

    public function addToCart(Request $request){
        $product = Product::where('id', $request->id)->first();

        if(!isset($_COOKIE['cart_id'])) setcookie('cart_id', uniqid());
        $cart_id = $_COOKIE['cart_id'];
        \Cart::session($cart_id);

        \Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => (int) $request->qty,
            'attributes' => [
                'main_photo_path' => $product->main_photo_path,
                'full_specification' => $product->full_specification
            ]
        ]);

        return response()->json(\Cart::getContent());
    }

}
