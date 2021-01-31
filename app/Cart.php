<?php


namespace App;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class Cart
{
    public ?array $products = [];

    public function __construct(Request $request)
    {
            $this->toSession();
            return $this;
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function isEmpty()
    {
        if ($this->products == null) {
            return true;
        }
        return false;
    }

    public function toSession()
    {
        Session::put('cart', $this);

    }

    public function calcTotalPrice()
    {
        if ($this->products == []) return 0;
        $totalPrice = 0;
        foreach ($this->products as $product) {
            $totalPrice = $totalPrice + ($product->getPrice());
        }
        return $totalPrice;
    }

    public function calcQty($product)
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
        /** @var Product $prod */
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
        /** @var Product $product */
        foreach ($this->products as $product) {
            $newProduct = new Product (\App\Models\Product::where('id', $product->getId())->firstOrFail());
            unset ($this->products[key($this->products)]);
            array_push($this->products, $newProduct);
        }
        $this->toSession();
    }
}
