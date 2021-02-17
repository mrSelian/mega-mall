<?php

namespace App;

use App\Domain\SellerInfoRepositoryInterface;
use App\Models\SellerInfo;

class DbSellerRepository implements SellerInfoRepositoryInterface
{

    public function getBySellerId(int $id)
    {
        return SellerInfo::where('user_id', '=', $id)->first();
    }
}
