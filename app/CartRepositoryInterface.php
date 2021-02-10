<?php


namespace App;
interface CartRepositoryInterface
{
    public function get();

    public function save(Cart $cart);
}
