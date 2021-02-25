<?php

namespace App\Domain;


interface CustomerInfoRepositoryInterface
{
    public function getByCustomerId(int $id): CustomerInfo;

    public function save(CustomerInfo $info);
}
