<?php


namespace App\Domain;

class Cart
{
    /** @var CartProduct[] $products */
    private array $products = [];
    private ?int $customerId;
    private ?int $sellerId;


    public function __construct(?int $customerId, ?int $sellerId, array $products)
    {
        $this->customerId = $customerId;
        $this->products = $products;
        $this->sellerId = $sellerId;
    }

    public function toArray(): array
    {
        return [
            'customerId' => $this->customerId,
            'sellerId' => $this->sellerId,
            'products' => array_map(fn(CartProduct $product) => $product->toArray(), $this->products),
        ];
    }

    public function getProductsIds(): array
    {
        return array_map(fn(CartProduct $product) => $product->getProductId(), $this->products);
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

    public function calculateTotalAmount(): int
    {
        $totalAmount = 0;
        foreach ($this->products as $product) {
            $totalAmount += $product->getAmount();
        }
        return $totalAmount;
    }

    public function calculateTotalPrice(): int
    {
        $totalPrice = 0;
        foreach ($this->products as $product) {
            $totalPrice += $product->calculateTotalPrice();
        }
        return $totalPrice;
    }

    public function addProduct(Product $product, int $amount)
    {
//        if ($this->sellerId != $product->getSellerId()) throw new \Exception('Невозможно добавить товар в корзину другого продавца!');
        if ($amount < 1) throw new \Exception('Невозможно добавить менее 1 товара!');

        $this->sellerId = $product->getSellerId();

        $cartProduct = $this->getProductById($product->getId());

        if (!$cartProduct) {
            $cartProduct = CartProduct::add($product, $amount);
            array_push($this->products, $cartProduct);
            return true;
        }

        return $this->correctAmount($product, $cartProduct->getAmount() + $amount);
    }

    public function correctAmount(Product $product, $amount): bool
    {
        $cartProduct = $this->getProductById($product->getId());
        if (!$cartProduct) throw new \Exception('Продукт не найден!');

        $this->removeProduct($cartProduct->getProductId());
        $this->addProduct($product, $amount);

        return true;
    }


    public function removeProduct(int $id)
    {
        foreach ($this->products as $product) {
            if ($product->getProductId() == $id) {
                unset ($this->products[key($this->products)]);
            }
        }
        if (!$this->products) $this->sellerId = null;
    }

    public function getProductById(int $id)
    {
        foreach ($this->products as $product) {
            if ($product->getProductId() == $id) return $product;
        }
        return null;
    }

    public function clear()
    {
        $this->products = [];
        $this->sellerId = null;
    }


    public function actualize($repository)
    {
        foreach ($this->products as $product) {
            $newProduct = $repository->getById($product->getProductId());
            unset ($this->products[key($this->products)]);
            array_push($this->products, new CartProduct($newProduct->getId(), $newProduct->getName(), $newProduct->getPrice(), $product->getSellerId(), $product->getAmount()));
        }
    }

    public function order(ProductRepositoryInterface $productRepository, CustomerAddress $address): Order
    {
        $this->actualize($productRepository);
        if ($this->products == []) throw new \Exception('В корзине нет товаров для заказа !');
        $order = new Order($this->sellerId, $this->customerId, $this->calculateTotalPrice(), $this->products, 'оформлен', $address);
        $this->clear();
        return $order;
    }


    public function getSellerId(): int
    {
        return $this->sellerId;
    }
}
