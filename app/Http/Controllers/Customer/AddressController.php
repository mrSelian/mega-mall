<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAddressRequest;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{

    public function create()
    {
        return view('customer.address.create');
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
