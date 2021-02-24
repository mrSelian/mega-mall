<?php

namespace App\Domain;

use App\Models\CustomerInfoModel;

interface CustomerInfoRepositoryInterface
{
    public function getByCustomerId(int $id);
    public function save(CustomerInfoModel $info);
}
