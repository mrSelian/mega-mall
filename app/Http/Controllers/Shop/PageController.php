<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function shop(Request $request)
    {
        $products = Product::where('quantity', '>', 0)->paginate(12);

        return view('shop.index', compact('products'));
    }

    public function showProduct($id)
    {
        $product = Product::findOrFail($id);
        return view('shop.product.show', compact('product'));
    }

    public function search(Request $request)
    {

    }
}
