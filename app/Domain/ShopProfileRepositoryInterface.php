<?php

namespace App\Domain;


interface ShopProfileRepositoryInterface
{
    public function getBySellerId(int $id): ?ShopProfile;

    public function save(ShopProfile $info);
}
