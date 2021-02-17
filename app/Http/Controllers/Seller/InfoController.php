<?php

namespace App\Http\Controllers\Seller;

use App\Domain\SellerInfoRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\SellerInfoRequest;
use App\Models\SellerInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InfoController extends Controller
{
    private SellerInfoRepositoryInterface $infoRepository;

    public function __construct(SellerInfoRepositoryInterface $infoRepository)
    {
        $this->infoRepository = $infoRepository;
    }

    public function sellerProfile(Request $request)
    {
        $info = $this->infoRepository->getBySellerId(Auth::id());
        return view('seller.profile',compact('info'));
    }

    public function create()
    {
        return view('seller.info.create');
    }

    public function store(SellerInfoRequest $request)
    {
        $request->user()->sellerInfo()->create($request->all());

        return redirect(route('seller_profile'));
    }

    public function edit(Request $request)
    {
        $info = $this->infoRepository->getBySellerId(Auth::id());
        return view('seller.info.edit', compact('info'));
    }

    public function update(SellerInfoRequest $request)
    {
        $info = $this->infoRepository->getBySellerId(Auth::id());
        $info->phone = $request->get('phone');
        $info->email = $request->get('email');
        $info->info = $request->get('info');
        $info->name = $request->get('name');
        $info->main_photo = $request->get('main_photo');
        $info->additional_contact = $request->get('additional_contact');
        $info->delivery_terms = $request->get('delivery_terms');
        $this->infoRepository->save($info);

        return redirect(route('seller_profile'));
    }
}
