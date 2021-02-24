<?php

namespace App\Domain;
interface OrderRepositoryInterface
{
    public function getById(int $id): Order;

    public function getBySellerId(int $sellerId);

    public function getByCustomerId(int $customerId);

    public function save(Order $order);
}
