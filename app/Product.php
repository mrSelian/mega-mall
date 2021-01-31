<?php


namespace App;


class Product
{
    private int $id;
    private string $name;
    private string $main_photo_path;
    public int $price;
    private int $quantity;
    private string $full_specification;
    private int $user_id;

    public function __construct($productRec)
    {
        $this->id = $productRec->id;
        $this->name = $productRec->name;
        $this->main_photo_path = $productRec->main_photo_path;
        $this->price = $productRec->price;
        $this->quantity = $productRec->quantity;
        $this->full_specification = $productRec->full_specification;
        $this->user_id = $productRec->user_id;
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
        return $this->main_photo_path;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getQuantitty()
    {
        return $this->quantity;
    }

    public function getFullSpec()
    {
        return $this->full_specification;
    }

    public function getUserId()
    {
        return $this->user_id;
    }


    public function qtyIsAvailable(int $qty)
    {
        if ($this->quantity >= $qty) {
            return true;
        }
        return false;
    }

}
