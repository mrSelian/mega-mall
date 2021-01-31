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
        if ($request->session()->has('cart')) {
            $cart = ($request->session()->get('cart'));
            $this->products = $cart->products;
            return $this;
        } else {
            $this->toSession();
            return $this;
        }
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

//переписать
    public function removeFromCart(\App\Product $product)
    {


        $this->toSession();

    }


    public function clear()
    {
        $this->products = [];

        $this->toSession();
    }
}
