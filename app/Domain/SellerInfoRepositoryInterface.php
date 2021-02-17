<?php

namespace App\Domain;

use App\Models\SellerInfo;

interface SellerInfoRepositoryInterface{
    public function getBySellerId(int $id);
    public function save(SellerInfo $info);
}
