<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAddressRequest;
use App\Models\Order;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{

    public function create()
    {
        return view('customer.address.create');
    }

    public function checkOut()
    {
        $cart = $this->cartRepositiry->get(Auth::id());

        $order = Order::checkOut($cart);

        $this->cartRepository->save($cart);
        $this->orderRepository->save($order);

//        return redirect()
    }

    public function addToCart(Request $request)
    {
        $cart = $this->cartRepositiry->get(Auth::id());
        $product = $this->productRepository->getById($request->id);

//        if(!$product) return redirect();

        $cart->addProduct($product, $request->amount);

        $this->cartRepository->save($cart);

//        return redirect();
    }

    public function update(CreateAddressRequest $request)
    {
        $user = $this->userRepository->getById(Auth::id());

        $user->updateAddress($request->all());

        $this->userRepository->save($user);


        $address = $this->addressRepository->getByUserId(Auth::id());

        $address->update($request->all());

        $this->addressRepository->save($address);


        $address = $request->user()->address();

        $address->update($request->all());

        $address->save();

        return redirect(route('customer_profile'));
    }

    public function store(CreateAddressRequest $request)
    {
        $request->user()->address()->create($request->all()

        );

        return redirect(route('customer_profile'));
    }

    public function edit(Request $request)
    {
        $address = $request->user()->address()->get()[0];
        return view('customer.address.edit', compact('address'));
    }

    public function update(CreateAddressRequest $request)
    {
        $address = $request->user()->address()->get()[0];
        $address->full_name = $request->get('full_name');
        $address->country = $request->get('country');
        $address->region = $request->get('region');
        $address->zip = $request->get('zip');
        $address->city = $request->get('city');
        $address->street = $request->get('street');
        $address->house = $request->get('house');
        $address->apt = $request->get('apt');
        $address->save();

        return redirect(route('customer_profile'));
    }
}
