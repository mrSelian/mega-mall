<?php


namespace App\Domain;

class OrderProduct

{
    private int $productId;
    private string $name;
    private int $price;
    private int $amount;
    private int $sellerId;

    protected function __construct(int $productId, string $name, int $price, int $sellerId, int $amount)
    {
        $this->productId = $productId;
        $this->name = $name;
        $this->price = $price;
        $this->sellerId = $sellerId;
        $this->amount = abs($amount);
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

    public static function fromCartProduct(CartProduct $product): OrderProduct
    {
        return new self($product->getProductId(), $product->getName(), $product->getPrice(), $product->getSellerId(), $product->getAmount());
    }

    public static function fromArray(array $product): OrderProduct
    {
        return new self($product['id'], $product['name'], $product['price'], $product['seller_id'], $product['amount']);
    }

    public function getProductId(): int
    {
        return $this->productId;
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
