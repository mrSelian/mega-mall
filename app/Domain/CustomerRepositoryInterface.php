<?php

namespace App\Domain;


interface CustomerRepositoryInterface
{
    public function getByCustomerId(int $id): Customer;

    public function save(Customer $info);
}
