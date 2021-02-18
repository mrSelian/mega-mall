<?php

namespace App\Domain;
interface ProductRepositoryInterface
{
    public function getById(int $id);

    public function getAllByUserId(int $id);

    public function getAllAvailable();

}
