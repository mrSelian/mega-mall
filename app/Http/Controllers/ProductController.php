<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::all();
        return view('index', compact('products'));
    }

    public function create()
    {
        return view('create_product');
    }

    public function store(Request $request)
    {
        Product::create($request->all());
        return redirect('/')->with('success', 'Товар добавлен успешно.');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('edit_product', compact('product'));
    }

    public function update(Request $request, $id)
    {

        $product = Product::find($id);

        $product->name = $request->get('name');
        $product->price = $request->get('price');
        $product->main_photo_path = $request->get('main_photo_path');
        $product->quantity = $request->get('quantity');
        $product->full_specification = $request->get('full_specification');
        $product->save();

        return redirect('/dashboard')->with('success', 'Товар успешно обновлен.');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();


        return redirect('/dashboard')->with('success', 'Товар удалён.');
    }

    public function for_user(Request $request)
    {
        $products = $request->user()->products()->get();


        return view('dashboard', compact('products'));
    }
}
