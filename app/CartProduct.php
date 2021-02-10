<?php


namespace App;

use App\Product;

class CartProduct
{
    private int $id;
    private string $name;
    private int $price;
    private int $amount;

    public function __construct(Product $product, int $amount)
    {
        $this->id = $product->getId();
        $this->name = $product->getName();
        $this->price = $product->getPrice();
        $this->amount = abs($amount);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function correctAmount(int $newAmount)
    {
        $product = $this->getProductById();
        if ($newAmount > $product->getAmount()) {
            throw new \Exception('Указаное количество больше остатка товара у продавца.');
        }

        $this->amount = abs($newAmount);

    }

    private function getProductById(): \App\Product
    {
        return new \App\Product(\App\Models\Product::where('id', '=', $this->id)->first());
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getPhoto(): string
    {
        $product = $this->getProductById();
        return $product->getPhoto();
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

}
