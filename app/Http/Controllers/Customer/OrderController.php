<?php

namespace App\Http\Controllers\Customer;

use App\Domain\OrderRepositoryInterface;
use App\Domain\ShopProfileRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    private OrderRepositoryInterface $orderRepository;
    private ShopProfileRepositoryInterface $sellerInfoRepository;


    public function __construct(OrderRepositoryInterface $orderRepository, ShopProfileRepositoryInterface $sellerInfoRepository)

    {
        $this->orderRepository = $orderRepository;
        $this->sellerInfoRepository = $sellerInfoRepository;
    }

    public function show($id)
    {
        $order = $this->orderRepository->getById($id);

        $this->authorize('showForCustomer', $order);

        $info = $this->sellerInfoRepository->getBySellerId($order->getSellerId());

        return view('shop.order.customer', compact('order', 'info'));

    }

    public function getAllByCustomer()
    {
        $orders = $this->orderRepository->getByCustomerId(Auth::id());

        return view('customer.orders', compact('orders'));
    }
}
