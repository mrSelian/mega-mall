<?php

namespace App;

use App\Domain\SellerInfoRepositoryInterface;
use App\Models\SellerInfoModel;

class DbSellerInfoRepository implements SellerInfoRepositoryInterface
{

    public function getBySellerId(int $id)
    {
        return SellerInfoModel::where('user_id', '=', $id)->first();
    }

    public function save(SellerInfoModel $info)
    {
        $info->save();
    }
}
