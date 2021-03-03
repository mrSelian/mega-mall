<?php

namespace App;

use App\Domain\CartProduct;
use App\Domain\CustomerAddress;
use App\Domain\Order;
use App\Domain\OrderProduct;
use App\Domain\OrderRepositoryInterface;
use App\Models\OrderModel;

class DbOrderRepository implements OrderRepositoryInterface
{

    public function getById(int $id): Order
    {
        $order = OrderModel::query()
            ->where('id', '=', $id)
            ->get()
            ->map($this->mapToOrder())
            ->first();

        if ($order == null) throw new \Exception('Заказ не найден!');

        return $order;

    }

    public function getBySellerId(int $sellerId)
    {
        return OrderModel::query()
            ->where('seller_id', '=', $sellerId)
            ->get()
            ->map($this->mapToOrder());
    }

    protected function mapToOrder(): \Closure
    {
        return fn(OrderModel $record) => new Order(
            $record->seller_id,
            $record->customer_id,
            $record->sum,
            array_map(fn(array $product) => OrderProduct::fromArray($product), json_decode($record->items, true)),
            $record->status,
            CustomerAddress::fromArray(json_decode($record->delivery_address,true)),
            $record->id
        );
    }


    public function getByCustomerId(int $customerId)
    {
        return OrderModel::query()
            ->where('customer_id', '=', $customerId)
            ->get()
            ->map($this->mapToOrder());
    }

    public function save(Order $order)
    {
        $record = OrderModel::where('id', '=', $order->getId())->firstOrNew();
        $record->seller_id = $order->getSellerId();
        $record->customer_id = $order->getCustomerId();
        $record->items = json_encode(array_map(fn(OrderProduct $product) => $product->toArray(), $order->getProducts()));
        $record->sum = $order->getSum();
        $record->status = $order->getStatus();
        $record->delivery_address = json_encode($order->getDeliveryAddress()->toArray());
        $record->save();
    }


}


