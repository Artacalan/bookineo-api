<?php

namespace App\Application\Query\Login;

class GetLoginQuery
{

    private string $email;
    private string $password;
    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public static function create(array $data): static
    {
        if (!isset($data['email'])) {
            throw new \InvalidArgumentException('Email is required');
        }
        if (!isset($data['password'])) {
            throw new \InvalidArgumentException('Password is required');
        }

        return new static($data['email'], $data['password']);
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

}
