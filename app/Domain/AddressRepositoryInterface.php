<?php

namespace App\Domain;

interface AddressRepositoryInterface
{
    public function getByUserId(int $id);
    public function save(Address $address);
}
