<?php

namespace App\Repositories\User;

class UserDTO
{
    private string $name;

    private string $email;

    private string $userType;

    private string $document;

    public function __construct(string $name, string $email, string $userType, string $document)
    {
        $this->name = $name;
        $this->email = $email;
        $this->userType = $userType;
        $this->document = $document;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getuserType(): string
    {
        return $this->userType;
    }

    public function getDocument(): string
    {
        return $this->document;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'personType' => $this->getPersonType(),
            'document' => $this->getDocument()
        ];
    }
}