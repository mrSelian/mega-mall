<?php


namespace App\Domain;


class Product
{
    private int $id;
    private string $name;
    private string $mainPhoto;
    private int $price;
    private int $amount;
    private string $description;
    private int $userId;

    public function __construct($productRec)
    {
        $this->id = $productRec->id;
        $this->name = $productRec->name;
        $this->mainPhoto = $productRec->main_photo_path;
        $this->price = $productRec->price;
        $this->amount = $productRec->quantity;
        $this->description = $productRec->full_specification;
        $this->userId = $productRec->user_id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPhoto(): string
    {
        return $this->mainPhoto;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function qtyIsAvailable(int $qty): bool
    {
        return $this->amount >= $qty;

    }

}
