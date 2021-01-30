<?php


namespace App;


class Product
{
    public int $id;
    public string $name;
    public string $main_photo_path;
    public int $price;
    public int $quantity;
    public string $full_specification;
    public int $user_id;

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

    public function qtyIsAvailable(int $qty)
    {
        if ($this->quantity >= $qty) {
            return true;
        }
        return false;
    }

}
