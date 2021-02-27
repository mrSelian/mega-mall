<?php

namespace App\Domain;

interface AddressRepositoryInterface
{
    public function getByUserId(int $id): CustomerAddress;

    public function save(CustomerAddress $address);
}
