<?php

namespace App\Domain;


interface SellerInfoRepositoryInterface
{
    public function getBySellerId(int $id): SellerInfo;

    public function save(SellerInfo $info);
}
