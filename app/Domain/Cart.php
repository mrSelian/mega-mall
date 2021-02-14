<?php


namespace App\Domain;

class Cart
{
    /** @var CartProduct[] $products */
    private array $products = [];
    private int $customerId;


    public function __construct(int $customerId, array $products)
    {
        $this->customerId = $customerId;
        $this->products = $products;
    }

    public function toArray(): array
    {
        return [
            'customerId' => $this->customerId,
            'products' => array_map(fn(CartProduct $product) => $product->toArray(), $this->products),
        ];
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    public function isEmpty(): bool
    {
        return !$this->products;
    }

    public function calculateTotalPrice(): int
    {
        $totalPrice = 0;
        foreach ($this->products as $product) {
            $totalPrice += $product->calculateTotalPrice();
        }
        return $totalPrice;
    }

    public function addToCart(CartProduct $product)
    {
        array_push($this->products, $product);

        if ($product->getAmount() == 0) $this->removeFromCart($product->getId());

    }

    public function removeFromCart(int $id)
    {
        foreach ($this->products as $product) {
            if ($product->getId() == $id) {
                unset ($this->products[key($this->products)]);
            }
        }
    }

    public function hasProductWithId(int $id)
    {
        foreach ($this->products as $product) {
            if ($product->getId() == $id) return $product;
        }
        return false;
    }

    public function clear()
    {
        $this->products = [];
    }

    public function correctAmount(Product $product, $amount)
    {
        foreach ($this->products as $productCart) {
            if ($productCart->getId() == $productCart->getId()) {
                $productCart->correctAmount($product, $amount);
            }
        }
    }

    public function actualize($repository)
    {
        foreach ($this->products as $product) {
            $newProduct = $repository->getById($product->getId());
            unset ($this->products[key($this->products)]);
            array_push($this->products, $newProduct);
        }
    }

    public function toOrder(OrderServiceInterface $service)
    {
        if ($this->products == []) throw new \Exception('В корзине нет товаров для заказа !');
        $service->create($this);
    }
}
