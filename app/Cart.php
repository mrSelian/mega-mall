<?php


namespace App;


use Illuminate\Support\Facades\Auth;

class Cart
{
    /** @var CartProduct[] $products */
    private array $products = [];
    private int $customerId;

    public function __construct()
    {
        $this->customerId = Auth::user()->id;
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    public function getCustomerId()
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

    public function correctAmount($id, $amount)
    {
        foreach ($this->products as $product) {
            if ($product->getId() == $id) {
                $product->correctAmount($amount);
            }
        }
    }

    public function actualize()
    {
        // сейчас не используется. Позже переписать
        // в параметре принимает что-то, что будет подключаться к базе,сессии и куда-то ещё ( репозиторий или сервис)
        foreach ($this->products as $product) {
            $newProduct = new Product (\App\Models\Product::where('id', $product->getId())->firstOrFail());
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
