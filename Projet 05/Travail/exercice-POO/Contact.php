<?php
/**
 * Represents a row of the table contact.
 */

class Contact
{
    private ?int $id;
    private ?string $name;
    private ?string $email;
    private ?string $phoneNumber;

    public function __construct(int $id = null, $name = null, $email = null, $phoneNumber = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
    }

    public function __toString(): string
    {
        return "Contact: id($this->id), name($this->name), email($this->email), phone_number($this->phoneNumber)";

    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(?int $newId): void
    {
        $this->id = $newId;
    }
    public function getName(): ?string
    {
        return $this->name;
    }
    public function setName(?string $newName): void
    {
        $this->name = $newName;
    }
    public function getEmail(): ?string
    {
        return $this->email;
    }
    public function setEmail(?string $newEmail): void
    {
        $this->email = $newEmail;
    }
    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }
    public function setPhoneNumber(?string $newPhoneNumber): void
    {
        $this->phoneNumber = $newPhoneNumber;
    }

}