<?php


namespace App;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class Cart
{
    /** @var Product[] $products */
    public array $products = [];

    public function __construct()
    {
        $this->toSession();
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    public function isEmpty(): bool
    {
        return !$this->products;
    }

    public function toSession()
    {
        Session::put('cart', $this);
// в класс cart repository который будет брать откуда-то и сохранять куда-то
    }

    public function calcTotalPrice(): int
    {
        $totalPrice = 0;
        foreach ($this->products as $product) {
            $totalPrice += $product->getPrice();
        }
        return $totalPrice;
    }

    public function calcQty($product): int
    {
        $qty = 0;
        foreach ($this->products as $prod) {
            if ($prod->getId() == $product->getId()) $qty++;
        }
        return $qty;
    }

    public function addToCart(\App\Product $product)
    {
        $newQty = 1 + $this->calcQty($product);

        if ($product->qtyIsAvailable($newQty)) {

            array_push($this->products, $product);

            $this->toSession();

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
        $this->toSession();
    }

    public function clear()
    {
        $this->products = [];

        $this->toSession();
    }

    public function actualize()
    {
        // в параметре принимает что-то, что будет подключаться к базе,сессии и куда-то ещё ( репозиторий или сервис)
        foreach ($this->products as $product) {
            $newProduct = new Product (\App\Models\Product::where('id', $product->getId())->firstOrFail());
            unset ($this->products[key($this->products)]);
            array_push($this->products, $newProduct);
        }
        $this->toSession();
    }

    public function toOrder()
    {
        if ($this->products == []) throw new \Exception('В корзине нет товаров для заказа !');
        dd('Тут будет страница заказа !');
    }
}
