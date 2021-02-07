<?php


namespace App;
interface CartRepositoryInterface
{
    public function get($source);

    public function save(Cart $cart);
}
