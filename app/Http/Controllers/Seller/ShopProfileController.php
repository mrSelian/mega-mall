<?php

namespace App\Http\Controllers\Seller;

use App\Domain\ShopProfileRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\SellerInfoRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ShopProfileController extends Controller
{
    private ShopProfileRepositoryInterface $infoRepository;

    public function __construct(ShopProfileRepositoryInterface $infoRepository)
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

    public function store(SellerInfoRequest $request): RedirectResponse
    {
        $request->user()->sellerInfo()->create($request->all());

        return redirect()->route('seller_profile');
    }

    public function edit()
    {
        $info = $this->infoRepository->getBySellerId(Auth::id());
        return view('seller.info.edit', compact('info'));
    }

    public function update(SellerInfoRequest $request): RedirectResponse
    {
        $info = $this->infoRepository->getBySellerId(Auth::id());

        $info->update(
            $request->name,
            $request->email,
            $request->deliveryTerms,
            $request->info,
            $request->mainPhoto,
            $request->phone,
            $request->additionalContact
        );

        $this->infoRepository->save($info);

        return redirect()->route('seller_profile');
    }
}
