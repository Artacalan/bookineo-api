<?php

namespace App\Application\Query\Register;

class GetRegisterQuery
{

    private string $first_name;
    private string $last_name;
    private string $email;
    private string $birthday;
    private string $password;

    public function __construct(string $first_name, string $last_name, string $email, string $birthday, string $password)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->birthday = $birthday;
        $this->password = $password;
    }

    public static function create(array $data): static
    {
        if (!isset($data['first_name'])) {
            throw new \InvalidArgumentException('First name is required');
        }
        if (!isset($data['last_name'])) {
            throw new \InvalidArgumentException('Last name is required');
        }
        if (!isset($data['email']) || empty(trim($data['email']))) {
            throw new \InvalidArgumentException('Email is required');
        }
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Invalid email format');
        }
        if (!isset($data['birthday'])) {
            throw new \InvalidArgumentException('Birthday is required');
        }
        if (!isset($data['password'])) {
            throw new \InvalidArgumentException('Password is required');
        }
        if (strlen($data['password']) < 8) {
            throw new \InvalidArgumentException('Password must be at least 8 characters long');
        }
        if (!preg_match('/[A-Z]/', $data['password'])) {
            throw new \InvalidArgumentException('Password must contain at least one uppercase letter');
        }
        if (!preg_match('/[a-z]/', $data['password'])) {
            throw new \InvalidArgumentException('Password must contain at least one lowercase letter');
        }
        if (!preg_match('/[0-9]/', $data['password'])) {
            throw new \InvalidArgumentException('Password must contain at least one digit');
        }

        return new static($data['first_name'], $data['last_name'], $data['email'], $data['birthday'], $data['password']);
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

    public function getPassword(): string
    {
        return $this->password;
    }

}
