<?php

namespace App\Domain;

interface CustomerAddressRepositoryInterface
{
    public function getByUserId(int $id): ?CustomerAddress;

    public function save(CustomerAddress $address);
}
