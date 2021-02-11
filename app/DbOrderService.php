<?php


namespace App;

use App\Models\Order;

class DbOrderService implements OrderServiceInterface
{
    public function create(Cart $cart)
    {
        // актуализация корзины
        $order = new Order;
        $order->customer_id = $cart->getCustomerId();
        dd($cart->getProducts());
        $order->seller_id = $cart->getProducts()[0]->getSellerId();
        $order->sum = $cart->calculateTotalPrice();
        $order->status = 'оформлен';
        $order->items = json_encode($cart->getProducts());
        $order->save();
        $cart->clear();
        dd($order);
        return redirect(route('customer_orders'));
    }

}
