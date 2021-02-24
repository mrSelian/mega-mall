<?php

namespace App;

use App\Domain\CustomerInfoRepositoryInterface;
use App\Models\CustomerInfoModel;

class DbCustomerInfoRepository implements CustomerInfoRepositoryInterface
{
    public function getByCustomerId(int $id)
    {
        return CustomerInfoModel::where('user_id','=',$id)->first();
    }

    public function save(CustomerInfoModel $info)
    {
        $info->save();
    }
}
