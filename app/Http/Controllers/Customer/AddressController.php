<?php

namespace App\Http\Controllers\Customer;

use App\DbAddressRepository;
use App\Domain\AddressRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAddressRequest;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    private AddressRepositoryInterface $addressRepository;

    public function __construct()
    {
        $this->addressRepository = new DbAddressRepository();
    }

    public function create()
    {
        if (!$this->addressRepository->getByUserId(Auth::id())) return view('customer.address.create');

        return redirect(route('edit_address'));
    }

//    public function checkOut()
//    {
//        $cart = $this->cartRepositiry->get(Auth::id());
//
//        $order = Order::checkOut($cart);
//
//        $this->cartRepository->save($cart);
//        $this->orderRepository->save($order);
//
//        return redirect()
//    }


    public function store(CreateAddressRequest $request)
    {
        $this->addressRepository->create($request);

        return redirect(route('customer_profile'));
    }

    public function edit()
    {
        $address = $this->addressRepository->getByUserId(Auth::id());
        return view('customer.address.edit', compact('address'));
    }

    public function update(CreateAddressRequest $request)
    {
        $address = $this->addressRepository->getByUserId(Auth::id());
        $address->update($request->all());
        $address->save();

        return redirect(route('customer_profile'));
    }
}
