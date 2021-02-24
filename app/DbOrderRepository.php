<?php

namespace App;

use App\Domain\CartProduct;
use App\Domain\Order;
use App\Domain\OrderRepositoryInterface;

class DbOrderRepository implements OrderRepositoryInterface
{

    public function getById(int $id): Order
    {
        $record = \App\Models\OrderModel::where('id', '=', $id)->firstOrFail();

        $products = array_map(fn(array $product) => new CartProduct($product['id'], $product['name'], $product['price'], $record->seller_id, $product['amount']), json_decode($record->items, true));

        return new Order($record->seller_id, $record->customer_id, $record->sum, $products, $record->status);
    }

    private function getModelById(?int $id)
    {
        return \App\Models\OrderModel::where('id', '=', $id)->firstOrNew();
    }

    public function getBySellerId(int $sellerId)
    {
        return \App\Models\OrderModel::where('seller_id', '=', $sellerId)->get();
    }

    public function getByCustomerId(int $customerId)
    {
        return \App\Models\OrderModel::where('customer_id', '=', $customerId)->get();
    }

    public function save(Order $order, int $id = null)
    {
        $record = $this->getModelById($id);
        $record->seller_id = $order->getSellerId();
        $record->customer_id = $order->getCustomerId();
        $record->items = json_encode(array_map(fn(CartProduct $product) => $product->toArray(), $order->getProducts()));
        $record->sum = $order->getSum();
        $record->status = $order->getStatus();
        $record->save();
    }


}


