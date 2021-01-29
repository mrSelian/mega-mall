<?php

namespace App\Http\Controllers;


use App\Models\Product;
use Illuminate\Http\Request;


class CartController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->session()->has('total'))
            session(['total' => 0]);

        return view('cart');
    }

    public function addToCart(Request $request)
    {
        $product = Product::where('id', $request->id)->first();

// дописать


        return view('cart');
    }

}
