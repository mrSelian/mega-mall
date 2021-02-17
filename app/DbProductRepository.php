<?php

namespace App;

use App\Domain\Product;
use App\Domain\ProductRepositoryInterface;

class DbProductRepository implements ProductRepositoryInterface

{
    public function getById(int $id): Product
    {
        return new Product(Models\Product::where('id', '=', $id)->firstOrFail());
    }

    public function getAllAvailable()
    {
        return \App\Models\Product::where('quantity', '>', 0)->paginate(12);
    }

    public function getAllByUserId($id)
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
