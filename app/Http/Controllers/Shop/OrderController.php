<?php

namespace App\Http\Controllers\Shop;

use App\Domain\AddressRepositoryInterface;
use App\Domain\CustomerInfoRepositoryInterface;
use App\Domain\OrderRepositoryInterface;
use App\Domain\SellerInfoRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    private OrderRepositoryInterface $orderRepository;
    private SellerInfoRepositoryInterface $sellerInfoRepository;
    private CustomerInfoRepositoryInterface $customerInfoRepository;
    private AddressRepositoryInterface $addressRepository;

    public function __construct(OrderRepositoryInterface $orderRepository,
                                SellerInfoRepositoryInterface $sellerInfoRepository,
                                CustomerInfoRepositoryInterface $customerInfoRepository,
                                AddressRepositoryInterface $addressRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->sellerInfoRepository = $sellerInfoRepository;
        $this->customerInfoRepository = $customerInfoRepository;
        $this->addressRepository = $addressRepository;
    }

    public function show($id)
    {
        $order = $this->orderRepository->getById($id);
        if (Auth::id() == $order->getSellerId()) {
            $info = $this->customerInfoRepository->getByCustomerId($order->getCustomerId());
            $address = $this->addressRepository->getByUserId($order->getCustomerId());
            return view('shop.order.seller', compact('order', 'info', 'address'));
        }

        if (Auth::id() == $order->getCustomerId()) {
            $info = $this->sellerInfoRepository->getBySellerId($order->getSellerId());
            return view('shop.order.customer', compact('order', 'info'));
        }

        return abort(403,'У вас нет доступа к данному заказу.');
    }


    public function changeStatus($id, Request $request): RedirectResponse
    {
        $order = $this->orderRepository->getById($id);

        $this->authorize('changeStatus', $order);

        $order->changeStatus($request->status);

        $this->orderRepository->save($order);

        return redirect()->route('seller_orders');

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
