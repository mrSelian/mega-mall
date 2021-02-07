<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::where('quantity','>',0)->paginate(12);
        return view('shop.index', compact('products'));
    }

    public function create()
    {
        return view('seller.product.create');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('shop.product.show', compact('product'));
    }

    public function store(CreateProductRequest $request)
    {
        $request->user()->products()->create($request->all()

        );

        return redirect(route('seller_products'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('seller.product.edit', compact('product'));
    }

    public function update(CreateProductRequest $request, $id)
    {

        $product = Product::findOrFail($id);

        $product->name = $request->get('name');
        $product->price = $request->get('price');
        $product->main_photo_path = $request->get('main_photo_path');
        $product->quantity = $request->get('quantity');
        $product->full_specification = $request->get('full_specification');
        $product->save();

        return redirect(route('seller_products'))->with('success', 'Товар успешно обновлен.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();


        return redirect(route('seller_products'))->with('success', 'Товар удалён.');
    }

    public function for_user(Request $request)
    {
        $products = $request->user()->products()->get();


        return view('seller.products', compact('products'));
    }
}
