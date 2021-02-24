<?php

namespace App\Domain;
interface ProductRepositoryInterface
{
    public function getById(int $id): Product;

    public function getAllByUserId(int $id);

    public function getAllAvailable();

    public function save(Product $product);

    public function delete(Product $product);

}
