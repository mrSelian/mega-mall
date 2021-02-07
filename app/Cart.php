<?php


namespace App;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class Cart
{
    /** @var Product[] $products */
    private array $products = [];
    private CartRepositoryInterface $repository;

    public function __construct(CartRepositoryInterface $repository)
    {
        $this->repository = $repository;
        $this->repository->save($this);
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    public function isEmpty(): bool
    {
        return !$this->products;
    }


    public function calculateTotalPrice(): int
    {
        $totalPrice = 0;
        foreach ($this->products as $product) {
            $totalPrice += $product->getPrice();
        }
        return $totalPrice;
    }

    public function calculateQty($product): int
    {
        $qty = 0;
        foreach ($this->products as $prod) {
            if ($prod->getId() == $product->getId()) $qty++;
        }
        return $qty;
    }

    public function addToCart(\App\Product $product)
    {
        $newQty = 1 + $this->calculateQty($product);

        if ($product->qtyIsAvailable($newQty)) {

            array_push($this->products, $product);

            $this->repository->save($this);

        } else {
            throw new \Exception('Запрашиваемое количество товара больше остатка !');
        }
    }

    public function removeFromCart(int $id)
    {
        foreach ($this->products as $prod) {
            if ($prod->getId() === $id) {
                unset ($this->products[key($this->products)]);
            }
        }
        $this->repository->save($this);
    }

    public function clear()
    {
        $this->products = [];

        $this->repository->save($this);
    }

    public function actualize()
    {
        // в параметре принимает что-то, что будет подключаться к базе,сессии и куда-то ещё ( репозиторий или сервис)
        foreach ($this->products as $product) {
            $newProduct = new Product (\App\Models\Product::where('id', $product->getId())->firstOrFail());
            unset ($this->products[key($this->products)]);
            array_push($this->products, $newProduct);
        }
        $this->repository->save($this);
    }

    public function toOrder()
    {
        if ($this->products == []) throw new \Exception('В корзине нет товаров для заказа !');
        dd('Тут будет страница заказа !');
    }
}
