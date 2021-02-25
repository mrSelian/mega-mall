<?php

namespace App\Domain;

interface AddressRepositoryInterface
{
    public function getByUserId(int $id): Address;

    public function save(Address $address);
}
