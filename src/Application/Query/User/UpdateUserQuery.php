<?php

namespace App\Application\Query\User;

class UpdateUserQuery
{
    private $id;
    private $first_name;
    private $last_name;
    private $email;
    private $birthday;

    public function __construct($id, $first_name, $last_name, $email, $birthday)
    {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->birthday = $birthday;
    }

    public static function create(array $data): static
    {
        if (!isset($data['id'])) {
            throw new \InvalidArgumentException('ID is required');
        }
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

        return new static($data['id'], $data['first_name'], $data['last_name'], $data['email'], $data['birthday']);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getBirthday()
    {
        return $this->birthday;
    }
}
