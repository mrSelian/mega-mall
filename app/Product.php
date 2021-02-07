<?php


namespace App;


class Product
{
    private int $id;
    private string $name;
    private string $mainPhoto;
    private int $price;
    private int $amount;
    private string $fullSpec;
    private int $userId;

    public function __construct($productRec)
    {
        $this->id = $productRec->id;
        $this->name = $productRec->name;
        $this->mainPhoto = $productRec->main_photo_path;
        $this->price = $productRec->price;
        $this->quantity = $productRec->quantity;
        $this->fullSpec = $productRec->full_specification;
        $this->userId = $productRec->user_id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPhoto()
    {
        return $this->mainPhoto;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getAmount()
    {
        return $this->quantity;
    }

    public function getFullSpec()
    {
        return $this->fullSpec;
    }

    public function getUserId()
    {
        return $this->userId;
    }


    public function qtyIsAvailable(int $qty): bool
    {
        return $this->quantity >= $qty;

    }

}
