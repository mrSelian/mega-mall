<?php


namespace App\Domain;


class Product
{
    private ?int $id;
    private string $name;
    private string $mainPhoto;
    private int $price;
    private int $amount;
    private string $description;
    private int $sellerId;
    private bool $deleted;

    public static function create(string $name, string $mainPhoto, int $price, int $amount, string $description, int $sellerId): Product
    {
        //проверка можно ли создать
        return new self($name, $mainPhoto, $price, $amount, $description, $sellerId);
    }

    public static function from(int $id, string $name, string $mainPhoto, int $price, int $amount, string $description, int $sellerId, bool $deleted): Product
    {
        $self = new self($name, $mainPhoto, $price, $amount, $description, $sellerId, $deleted);
        $self->id = $id;
        return $self;
    }

//    public static function fromArray(array $data): Product
//    {
//        return  self::from(
//            $data['id'],
//            $data['name'],
//            $data['mainPhoto']
//        );
//    }

    protected function __construct(string $name, string $mainPhoto, int $price, int $amount, string $description, int $sellerId, bool $deleted = false)
    {
        $this->id = null;
        $this->name = $name;
        $this->mainPhoto = $mainPhoto;
        $this->price = $price;
        $this->amount = $amount;
        $this->description = $description;
        $this->sellerId = $sellerId;
        $this->deleted = $deleted;
    }

    public function delete()
    {
        $this->deleted = true;
    }

    public function getId(): ?int
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

    public function getSellerId(): int
    {
        return $this->sellerId;
    }

    public function qtyIsAvailable(int $qty): bool
    {
        return $this->amount >= $qty;
    }

    public function update(string $name, string $mainPhoto, int $price, int $amount, string $description)
    {
        if ($amount < 0) throw new \Exception('Невозможно задать остаток товара менее 0.');
        if ($price < 0) throw new \Exception('Невозможно задать цену товара менее 0.');

        $this->name = $name;
        $this->mainPhoto = $mainPhoto;
        $this->price = $price;
        $this->amount = $amount;
        $this->description = $description;
    }


    public function isDeleted(): bool
    {
        return $this->deleted;
    }


}
