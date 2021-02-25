<?php

namespace App\Http\Controllers\Seller;

use App\Domain\SellerInfoRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\SellerInfoRequest;
use Illuminate\Support\Facades\Auth;

class InfoController extends Controller
{
    private SellerInfoRepositoryInterface $infoRepository;

    public function __construct(SellerInfoRepositoryInterface $infoRepository)
    {
        $this->infoRepository = $infoRepository;
    }

    public function sellerProfile()
    {
        $info = $this->infoRepository->getBySellerId(Auth::id());
        return view('seller.profile', compact('info'));
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

    public function edit()
    {
        $info = $this->infoRepository->getBySellerId(Auth::id());
        return view('seller.info.edit', compact('info'));
    }

    public function update(SellerInfoRequest $request)
    {
        $info = $this->infoRepository->getBySellerId(Auth::id());

        $info->update(
            $request->name,
            $request->email,
            $request->delivery_terms,
            $request->info,
            $request->main_photo,
            $request->phone,
            $request->additional_contact
        );

        $this->infoRepository->save($info);

        return redirect(route('seller_profile'));
    }
}
