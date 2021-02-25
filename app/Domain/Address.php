<?php


namespace App\Domain;

class Address
{
    private int $userId;
    private int $zip;
    private string $country;
    private string $region;
    private string $city;
    private string $street;
    private string $house;
    private string $apt;
    private string $fullName;

    public function __construct(int $userId, int $zip, string $country, string $region, string $city, string $street, string $house, string $apt, string $fullName)
    {
        $this->userId = $userId;
        $this->zip = $zip;
        $this->country = $country;
        $this->region = $region;
        $this->city = $city;
        $this->street = $street;
        $this->house = $house;
        $this->apt = $apt;
        $this->fullName = $fullName;
    }

    public function getFullName(): string
    {
        return $this->fullName;
    }


    public function getApt(): string
    {
        return $this->apt;
    }


    public function getHouse(): string
    {
        return $this->house;
    }


    public function getStreet(): string
    {
        return $this->street;
    }


    public function getCity(): string
    {
        return $this->city;
    }


    public function getRegion(): string
    {
        return $this->region;
    }


    public function getCountry(): string
    {
        return $this->country;
    }


    public function getZip(): int
    {
        return $this->zip;
    }


    public function getUserId(): int
    {
        return $this->userId;
    }

    public function update(int $zip, string $country, string $region, string $city, string $street, string $house, string $apt, string $fullName)
    {
        $this->zip = $zip;
        $this->country = $country;
        $this->region = $region;
        $this->city = $city;
        $this->street = $street;
        $this->house = $house;
        $this->apt = $apt;
        $this->fullName = $fullName;
    }


}
