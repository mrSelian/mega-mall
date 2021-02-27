<?php

namespace App\Domain;

class ShopProfile
{
    private int $sellerId;
    private string $shopName;
    private string $email;
    private string $deliveryTerms;
    private ?string $info;
    private ?string $mainPhoto;
    private ?string $phone;
    private ?string $additionalContact;

    public function __construct(
        int $sellerId,
        string $shopName,
        string $email,
        string $deliveryTerms,
        string $info = null,
        string $mainPhoto = null,
        string $phone = null,
        string $additionalContact = null
    )
    {
        $this->sellerId = $sellerId;
        $this->shopName = $shopName;
        $this->email = $email;
        $this->deliveryTerms = $deliveryTerms;
        $this->info = $info;
        $this->mainPhoto = $mainPhoto;
        $this->phone = $phone;
        $this->additionalContact = $additionalContact;
    }


    public function getSellerId(): int
    {
        return $this->sellerId;
    }


    public function getShopName(): string
    {
        return $this->shopName;
    }


    public function getEmail(): string
    {
        return $this->email;
    }


    public function getDeliveryTerms(): string
    {
        return $this->deliveryTerms;
    }


    public function getInfo(): ?string
    {
        return $this->info;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }


    public function getMainPhoto(): ?string
    {
        return $this->mainPhoto;
    }


    public function getAdditionalContact(): ?string
    {
        return $this->additionalContact;
    }

    public function update(
        string $shopName,
        string $email,
        string $deliveryTerms,
        string $info = null,
        string $mainPhoto = null,
        string $phone = null,
        string $additionalContact = null
    )
    {
        $this->shopName = $shopName;
        $this->email = $email;
        $this->deliveryTerms = $deliveryTerms;
        $this->info = $info;
        $this->mainPhoto = $mainPhoto;
        $this->phone = $phone;
        $this->additionalContact = $additionalContact;
    }


}
