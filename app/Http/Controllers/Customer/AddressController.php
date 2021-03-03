<?php

namespace App\Http\Controllers\Customer;

use App\Domain\CustomerAddress;
use App\Domain\CustomerAddressRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAddressRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    private CustomerAddressRepositoryInterface $addressRepository;

    public function __construct(CustomerAddressRepositoryInterface $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    public function create()
    {
        if (!$this->addressRepository->getByUserId(Auth::id())) return view('customer.address.create');

        return redirect()->route('edit_address');
    }

//    public function checkOut()
//    {
//        $cart = $this->cartRepositiry->get(Auth::id());
//
//        $order = OrderModel::checkOut($cart);
//
//        $this->cartRepository->save($cart);
//        $this->orderRepository->save($order);
//
//        return redirect()
//    }


    public function store(CreateAddressRequest $request): RedirectResponse
    {
        $this->addressRepository->save(
            new CustomerAddress(
                Auth::id(),
                $request->zip,
                $request->country,
                $request->region,
                $request->city,
                $request->street,
                $request->house,
                $request->apt,
                $request->fullName
            ));

        return redirect()->route('customer_profile');
    }

    public function edit()
    {
        $address = $this->addressRepository->getByUserId(Auth::id());
        return view('customer.address.edit', compact('address'));
    }

    public function update(CreateAddressRequest $request): RedirectResponse
    {
        $address = $this->addressRepository->getByUserId(Auth::id());
        $address->update(
            $request->zip,
            $request->country,
            $request->region,
            $request->city,
            $request->street,
            $request->house,
            $request->apt,
            $request->fullName
        );
        $this->addressRepository->save($address);

        return redirect()->route('customer_profile');
    }
}
