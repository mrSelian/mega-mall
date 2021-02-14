<?php

namespace App;

use App\Domain\CartProduct;
use App\Domain\Order;
use App\Domain\OrderRepositoryInterface;

class DbOrderRepository implements OrderRepositoryInterface
{

    public function getById(int $id): Order
    {
        $record = \App\Models\Order::where('id','=',$id)->firstOrFail();

        $products = array_map(fn(array $product) => new CartProduct($product['id'],$product['name'],$product['price'],$product['amount']), json_decode($record->items,true));

        return new Order($record->seller_id,$record->customer_id,$record->sum,$products,$record->status);
    }

    public function getBySellerId(int $sellerId)
    {
        return \App\Models\Order::where('seller_id','=',$sellerId)->get();
    }

    public function getByCustomerId(int $customerId)
    {
        return \App\Models\Order::where('customer_id','=',$customerId)->get();
    }

    public function save(Order $order)
    {
        $record = new \App\Models\Order;

        $record->seller_id = $order->getSellerId();
        $record->customer_id = $order->getCustomerId();
        $record->items = json_encode(array_map(fn(CartProduct $product) => $product->toArray(), $order->getProducts()));
        $record->sum = $order->getSum();
        $record->status = $order->getStatus();

        $record->save();
    }
}


