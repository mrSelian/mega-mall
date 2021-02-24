<?php

namespace App\Domain;

use App\Models\SellerInfoModel;

interface SellerInfoRepositoryInterface{
    public function getBySellerId(int $id);
    public function save(SellerInfoModel $info);
}
