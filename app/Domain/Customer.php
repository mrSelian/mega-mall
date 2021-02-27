<?php


namespace App\Domain;

class Customer
{
    private string $email;
    private int $id;
    private ?string $phone;
    private ?string $additionalContact;


    public function __construct(string $email, int $id, string $phone = null, string $additionalContact = null)
    {
        $this->email = $email;
        $this->id = $id;
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


    public function getId(): int
    {
        return $this->id;
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
