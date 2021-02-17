<?php

namespace App\Domain;

use App\Models\CustomerInfo;

interface CustomerInfoRepositoryInterface
{
    public function getByCustomerId(int $id);
    public function save(CustomerInfo $info);
}
