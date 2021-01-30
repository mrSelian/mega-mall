<?php


namespace App;

use App\Product;


class Cart
{
    public array $products;

    public function __construct()
    {
        if (session()->has('cart')) {
            return session('cart');
        }
        $this->products = [];
        $this->toSession();
        return $this;
    }

    public function isEmpty()
    {
        if ($this->products == []) {
            return true;
        }
        return false;
    }

    public function toSession()
    {
        session('cart', $this);
    }

    public function calcTotalPrice()
    {
        $totalPrice = 0;

        foreach ($this->products as $product => $qty) {
            $totalPrice = $totalPrice + ($product->price * $qty);
        }

        return $totalPrice;
    }

    private function cartHasProduct($productRec)
    {
        $id = $productRec->id;
        foreach ($this->products as $product => $qty) {
            if ($product->id = $id) return $product;
        }
        $product = new Product($productRec);
        array_push($this->products, [$product] = 0);
        return $product;

    }

    public function addToCart($productRec)
    {
        $product = $this->cartHasProduct($productRec);

        $newQty = $this->products[$product]++;

        if ($product->qtyIsAvailable($newQty)) {

            $this->products[$product] = $newQty;

            $this->toSession();


        } else {
            //Exception
        }
    }

    public function removeFromCart($productRec)
    {
        $product = $this->cartHasProduct($productRec);

        $newQty = $this->products[$product]--;

        $this->products[$product] = $newQty;

        $this->cartCheck();

        $this->toSession();

    }

    private function cartCheck()
    {
        foreach ($this->products as $product => $qty) {
            if ($qty <= 0) unset($this->products[$product]);
        }

    }

    public function clear()
    {
        $this->products = [];

        $this->toSession();
    }
}
