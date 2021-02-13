<?php


namespace App\Domain;


class CartProduct
{
    private int $id;
    private string $name;
    private int $price;
    private int $amount;

    public function __construct(int $id, string $name, int $price, int $amount)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->amount = abs($amount);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'amount' => $this->amount,
        ];
    }

//    public static function fromProduct(ProductSpec $product, $amount)
//    {
//        return new self($product->getId(), $product->getName(), $product->getPrice(), $amount);
//    }

    public function getName(): string
    {
        return $this->name;
    }

    public function calculateTotalPrice()
    {
        return $this->price * $this->amount;
    }

    public function correctAmount(Product $product, int $newAmount)
    {
        if (!$product->qtyIsAvailable($newAmount)) {
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

}
