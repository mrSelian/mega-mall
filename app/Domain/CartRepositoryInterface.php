<?php


namespace App\Domain;
interface CartRepositoryInterface
{
    public function get():Cart;

    public function save(Cart $cart);

    public function getPhotosForCart(Cart $cart):array;
}
