<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\SellerInfo;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function shop()
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

    public function customerProfile(Request $request)
    {
        $address = $request->user()->address()->first();
        $info = $request->user()->customerInfo()->first();
        return view('customer.profile', compact('address'),compact('info'));
    }

    public function sellerProfile(Request $request)
    {
        $info = $request->user()->sellerInfo()->first();
        return view('seller.profile',compact('info'));
    }

    public function sellerShop($id)
    {
        $products = Product::where('user_id', '=', $id)->paginate(12);

        $info = SellerInfo::where('user_id', '=', $id)->first();

        return view('shop.seller', compact('products'),compact('info'));
    }
}
