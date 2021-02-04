<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAddressRequest;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function show(Request $request)
    {
        $address = $request->user()->address()->get()[0];
        return view('customer.index', compact('address'));
    }

    public function store(CreateAddressRequest $request)
    {
        $request->user()->address()->create($request->all()

        );

        return redirect(route('customer'));
    }

    public function edit(Request $request)
    {
        $address = $request->user()->address()->get()[0];
        return view('address.edit', compact('address'));
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

        return redirect(route('customer'));
    }
}
