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

    public function getPhoto(int $id): string
    {
        $product = $this->getById($id);
        return $product->getPhoto();
    }


}
