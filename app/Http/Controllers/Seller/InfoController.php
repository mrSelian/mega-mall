<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\SellerInfoRequest;
use App\Models\SellerInfo;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function sellerProfile(Request $request)
    {
        $info = $request->user()->sellerInfo()->first();
        return view('seller.profile',compact('info'));
    }

    public function create()
    {
        return view('seller.info.create');
    }

    public function getBySellerId(int $id)
    {
        return SellerInfo::where('user_id','=',$id)->first();
    }

    public function store(SellerInfoRequest $request)
    {
        $request->user()->sellerInfo()->create($request->all());

        return redirect(route('seller_profile'));
    }

    public function edit(Request $request)
    {
        $info = $request->user()->sellerInfo()->get()[0];
        return view('seller.info.edit', compact('info'));
    }

    public function update(SellerInfoRequest $request)
    {
        $info = $request->user()->sellerInfo()->get()[0];
        $info->phone = $request->get('phone');
        $info->email = $request->get('email');
        $info->info = $request->get('info');
        $info->name = $request->get('name');
        $info->main_photo = $request->get('main_photo');
        $info->additional_contact = $request->get('additional_contact');
        $info->delivery_terms = $request->get('delivery_terms');
        $info->save();

        return redirect(route('seller_profile'));
    }
}