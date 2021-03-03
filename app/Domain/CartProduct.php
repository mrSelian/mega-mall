<?php


namespace App\Domain;


use Exception;

class CartProduct
{
    private int $productId;
    private string $name;
    private int $price;
    private int $amount;
    private int $sellerId;

    public function __construct(int $productId, string $name, int $price, int $sellerId, int $amount)
    {
        $this->productId = $productId;
        $this->name = $name;
        $this->price = $price;
        $this->sellerId = $sellerId;
        $this->amount = abs($amount);
    }

    public static function fromArray(array $product): CartProduct
    {
        return new self($product['id'], $product['name'], $product['price'], $product['seller_id'], $product['amount']);
    }

    public static function add(Product $product, int $amount): CartProduct
    {
        if (!$product->qtyIsAvailable($amount)) throw new Exception('Запрашиваемое количество товара больше остатка !');
        if ($product->isDeleted()) throw new Exception('Невозможно приобрести удаленный товар!');

        return new self($product->getId(), $product->getName(), $product->getPrice(), $product->getSellerId(), abs($amount));
    }


    public function getProductId(): int
    {
        return $this->productId;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->productId,
            'name' => $this->name,
            'price' => $this->price,
            'seller_id' => $this->sellerId,
            'amount' => $this->amount,
        ];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function calculateTotalPrice()
    {
        return $this->price * $this->amount;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getSellerId(): int
    {
        return $this->sellerId;
    }

}
