<?php

namespace App\Http\Controllers\Seller;

use App\Domain\AddressRepositoryInterface;
use App\Domain\CustomerRepositoryInterface;
use App\Domain\OrderRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    private OrderRepositoryInterface $orderRepository;
    private CustomerRepositoryInterface $customerInfoRepository;
    private AddressRepositoryInterface $addressRepository;

    public function __construct(OrderRepositoryInterface $orderRepository,
                                CustomerRepositoryInterface $customerInfoRepository,
                                AddressRepositoryInterface $addressRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->customerInfoRepository = $customerInfoRepository;
        $this->addressRepository = $addressRepository;
    }

    public function show($id)
    {
        $order = $this->orderRepository->getById($id);
        $this->authorize('showForSeller', $order);

        $info = $this->customerInfoRepository->getByCustomerId($order->getCustomerId());
        $address = $this->addressRepository->getByUserId($order->getCustomerId());

        return view('shop.order.seller', compact('order', 'info', 'address'));
    }

    public function changeStatus($id, Request $request): RedirectResponse
    {
        $order = $this->orderRepository->getById($id);

        $this->authorize('changeStatus', $order);

        $order->changeStatus($request->status);

        $this->orderRepository->save($order);

        return redirect()->route('seller_orders');

    }

    public function getAllBySeller()
    {
        $orders = $this->orderRepository->getBySellerId(Auth::id());

        return view('seller.orders', compact('orders'));
    }


}
