<?php

namespace App;

use App\Domain\CustomerInfoRepositoryInterface;
use App\Models\CustomerInfo;

class DbCustomerInfoRepository implements CustomerInfoRepositoryInterface
{
    public function getByCustomerId(int $id)
    {
        return CustomerInfo::where('user_id','=',$id)->first();
    }

    public function save(CustomerInfo $info)
    {
        $info->save();
    }
}
