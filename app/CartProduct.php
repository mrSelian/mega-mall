<?php


namespace App;

class CartProduct
{
    private int $id;
    private string $name;
    private int $price;
    private int $amount;
    private Product $source;

    // продукт не хранится в классе. Корзина запрашивает у кого-то нужную инфу о товаре для вывода. Может и нейм не нужен.

    public function __construct(Product $product, int $amount)
    {
        $this->id = $product->getId();
        $this->name = $product->getName();
        $this->price = $product->getPrice();
        $this->amount = abs($amount);
        $this->source = $product;
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
        if ($newAmount > $this->source->getAmount()) {
            throw new \Exception('Указаное количество больше остатка товара у продавца.');
        }

        $this->amount = abs($newAmount);

    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }


    public function getSource(): Product
    {
        return $this->source;
    }
}
