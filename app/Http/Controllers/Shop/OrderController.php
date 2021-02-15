<?php

namespace App\Http\Controllers\Shop;

use App\DbOrderRepository;
use App\DbProductRepository;
use App\Domain\Cart;
use App\Domain\Order;
use App\Domain\OrderRepositoryInterface;
use App\Domain\ProductRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Customer\AddressController;
use App\Http\Controllers\Customer\InfoController;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    private OrderRepositoryInterface $orderRepository;
    private ProductRepositoryInterface $productRepository;

    public function __construct()
    {
        $this->orderRepository = new DbOrderRepository();
        $this->productRepository = new DbProductRepository();
    }

    public function show($id)
    {
        $order = $this->orderRepository->getById($id);

        if (Auth::id() == $order->getSellerId()) {
            $infoController = new InfoController();
            $info=$infoController->getByCustomerId($order->getCustomerId());
            $addressController = new AddressController();
            $address = $addressController->getByUserId($order->getCustomerId());
            return view('shop.order.seller', compact('order','info','address'));
        }

        if (Auth::id() == $order->getCustomerId()) {
            $infoController = new \App\Http\Controllers\Seller\InfoController();
            $info =  $infoController->getBySellerId($order->getSellerId());
            return view('shop.order.customer', compact('order','info'));
        }

        return abort(403);
    }

    public function create(Cart $cart): Order
    {
        return new Order($this->productRepository->getSellerId($cart->getProducts()[array_key_first($cart->getProducts())]->getId()), $cart->getCustomerId(), $cart->calculateTotalPrice(), $cart->getProducts(), 'оформлен');
    }

    public function save(Order $order)
    {
        $this->orderRepository->save($order);
    }

    public function changeStatus($id, Request $request)
    {
        $order = $this->orderRepository->getById($id);

        $this->authorize('changeStatus', $order);

        $order->changeStatus($request->status);

        \App\Models\Order::where('id', '=', $id)->delete();

        $this->save($order);

        return redirect(route('seller_orders'));

    }

    public function sellerOrders()
    {
        $orders = $this->orderRepository->getBySellerId(Auth::id());

        return view('seller.orders', compact('orders'));
    }

    public function customerOrders()
    {
        $orders = $this->orderRepository->getByCustomerId(Auth::id());

        return view('customer.orders', compact('orders'));

    }
}
