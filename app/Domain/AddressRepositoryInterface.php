<?php

namespace App\Domain;

interface AddressRepositoryInterface
{
    public function getByUserId(int $id);
    public function create($source);
    public function save($address);
}
