<?php

namespace App\Domain;

class Order
{
    /** @var CartProduct[] $products */
    private array $products;
    private int $sellerId;
    private int $customerId;
    private int $sum;
    private string $status;


    public function __construct(int $sellerId, int $customerId, int $sum, array $products, string $status)
    {
        $this->sellerId = $sellerId;
        $this->customerId = $customerId;
        $this->sum = $sum;
        $this->products = $products;
        $this->status = $status;

    }

    public function changeStatus(string $status)
    {
        $statuses = [
//            'возврат',
//            'отменён',
            'оформлен',
            'оплачен',
            'собран',
            'отправлен',
            'доставлен',
        ];

        if (!in_array($status, $statuses)) return abort(403, 'Некорректный статус заказа');

        $this->status = $status;

    }

    public function calculateCommission(): float
    {
        return $this->sum * 0.05;
    }


    public function getSellerId(): int
    {
        return $this->sellerId;
    }


    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    public function getSum(): int
    {
        return $this->sum;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getProducts(): array
    {
        return $this->products;
    }

}
