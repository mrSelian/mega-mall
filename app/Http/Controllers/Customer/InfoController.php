<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerInfoRequest;
use App\Models\CustomerInfo;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function customerProfile(Request $request)
    {
        $address = $request->user()->address()->first();
        $info = $request->user()->customerInfo()->first();
        return view('customer.profile', compact('address'),compact('info'));
    }

    public function getByCustomerId(int $id)
    {
        return CustomerInfo::where('user_id','=',$id)->first();
    }

    public function create()
    {
        return view('customer.info.create');
    }

    public function store(CustomerInfoRequest $request)
    {
        $request->user()->customerInfo()->create($request->all()

        );

        return redirect(route('customer_profile'));
    }

    public function edit(Request $request)
    {
        $info = $request->user()->customerInfo()->get()[0];
        return view('customer.info.edit', compact('info'));
    }

    public function update(CustomerInfoRequest $request)
    {
        $info = $request->user()->customerInfo()->get()[0];
        $info->phone = $request->get('phone');
        $info->email = $request->get('email');
        $info->additional_contact = $request->get('additional_contact');
        $info->save();

        return redirect(route('customer_profile'));
    }
}
