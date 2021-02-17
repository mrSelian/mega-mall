<?php

namespace App;

use App\Domain\SellerInfoRepositoryInterface;
use App\Models\SellerInfo;

class DbSellerInfoRepository implements SellerInfoRepositoryInterface
{

    public function getBySellerId(int $id)
    {
        return SellerInfo::where('user_id', '=', $id)->first();
    }

    public function save(SellerInfo $info)
    {
        $info->save();
    }
}
