<?php


namespace App\Domain;
interface CartRepositoryInterface
{
    public function get();

    public function save(array $cart);
}
