<?php

namespace App\Application\Query\User;

class VerifyUserQuery
{
    private string $first_name;
    private string $last_name;
    private string $email;
    private string $birthday;

    public function __construct(string $first_name, string $last_name, string $email, string $birthday)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->birthday = $birthday;
    }

    public static function create(array $data): static
    {
        if (!isset($data['first_name'])) {
            throw new \InvalidArgumentException('First name is required');
        }
        if (!isset($data['last_name'])) {
            throw new \InvalidArgumentException('Last name is required');
        }
        if (!isset($data['email'])) {
            throw new \InvalidArgumentException('Email is required');
        }
        if (!isset($data['birthday'])) {
            throw new \InvalidArgumentException('Birthday is required');
        }

        return new static($data['first_name'], $data['last_name'], $data['email'], $data['birthday']);
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getBirthday(): string
    {
        return $this->birthday;
    }
}
