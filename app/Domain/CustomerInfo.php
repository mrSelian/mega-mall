<?php


namespace App\Domain;

class CustomerInfo
{
    private string $email;
    private int $userId;
    private ?string $phone;
    private ?string $additionalContact;


    public function __construct(string $email, int $userId, string $phone = null, string $additionalContact = null)
    {
        $this->email = $email;
        $this->userId = $userId;
        $this->phone = $phone;
        $this->additionalContact = $additionalContact;
    }

    public function update(string $email, string $phone = null, string $additionalContact = null)
    {
        $this->email = $email;
        $this->phone = $phone;
        $this->additionalContact = $additionalContact;
    }


    public function getEmail(): string
    {
        return $this->email;
    }


    public function getUserId(): int
    {
        return $this->userId;
    }


    public function getPhone(): ?string
    {
        return $this->phone;
    }


    public function getAdditionalContact(): ?string
    {
        return $this->additionalContact;
    }

}
