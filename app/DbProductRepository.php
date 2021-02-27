<?php

namespace App;

use App\Domain\Product;
use App\Domain\ProductRepositoryInterface;
use App\Models\ProductModel;



class DbProductRepository implements ProductRepositoryInterface

{
    public function getById(int $id): Product
    {
        return ProductModel::withId($id)
            ->get()
            ->map($this->mapToProduct())
            ->first();
    }

    public function getAllAvailable()
    {
        return ProductModel::query()
            ->where('quantity', '>', 0)->where('deleted', '=', 0)
            ->get()
            ->map($this->mapToProduct());
    }

    public function getAllByUserId(int $id)
    {
        return ProductModel::query()
            ->where('user_id', '=', $id)->where('deleted', '=', 0)
            ->get()
            ->map($this->mapToProduct());
    }

    protected function mapToProduct(): \Closure
    {
        return fn(ProductModel $item) => Product::from(
            $item->id,
            $item->name,
            $item->main_photo_path,
            $item->price,
            $item->quantity,
            $item->full_specification,
            $item->user_id,
            (bool)$item->deleted
        );
    }

    public function save(Product $product)
    {
        $record = ProductModel::withId($product->getId())->firstOrNew();
        $record->name = $product->getName();
        $record->price = $product->getPrice();
        $record->main_photo_path = $product->getPhoto();
        $record->quantity = $product->getAmount();
        $record->full_specification = $product->getDescription();
        $record->user_id = $product->getSellerId();
        $record->deleted = (int)$product->isDeleted();
        $record->save();

    }

    public function delete(Product $product)
    {
        $record = ProductModel::withId($product->getId())->firstOrFail();

        $record->deleted = 1;
        $record->save();
    }


}
