<?php

namespace App;

use App\Domain\Product;
use App\Domain\ProductRepositoryInterface;
use App\Http\Requests\CreateProductRequest;

class DbProductRepository implements ProductRepositoryInterface

{
    public function getById(int $id): Product
    {
        return new Product(Models\Product::where('id', '=', $id)->firstOrFail());
    }

    private function getModelById(int $id)
    {
        return Models\Product::where('id', '=', $id)->firstOrFail();
    }


    public function getAllAvailable()
    {
        return \App\Models\Product::where('quantity', '>', 0)->paginate(12);
    }


    public function create(CreateProductRequest $request)
    {
        $request->user()->products()->create($request->all());
    }

    public function update(CreateProductRequest $request, int $id)
    {
        $product = $this->getModelById($id);
        $product->name = $request->get('name');
        $product->price = $request->get('price');
        $product->main_photo_path = $request->get('main_photo_path');
        $product->quantity = $request->get('quantity');
        $product->full_specification = $request->get('full_specification');
        $product->save();
    }

    public function delete(int $id)
    {
        $product = $this->getModelById($id);

        $product->delete();
    }


    public function getAllByUserId(int $id)
    {
        $records = \App\Models\Product::where('user_id', '=', $id)->get();
        $products = $records->map(function ($item, $key) {
            return new Product($item);
        });
        return $products;
    }

    public function getPhoto(int $productId): string
    {
        $product = $this->getById($productId);
        return $product->getPhoto();
    }

    public function getSellerId(int $productId): int
    {
        $product = $this->getById($productId);
        return $product->getSellerId();
    }


}
