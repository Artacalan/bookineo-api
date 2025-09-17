<?php

namespace App\Application\Query\User;

class ChangePasswordQuery
{
    private $id;
    private $newPassword;

    public function __construct(int $id, string $newPassword)
    {
        $this->id = $id;
        $this->newPassword = $newPassword;
    }

    public static function create(array $data): static
    {
        if (!isset($data['id'])) {
            throw new \InvalidArgumentException('User ID is required');
        }
        if (!isset($data['new_password'])) {
            throw new \InvalidArgumentException('New password is required');
        }

        return new static($data['id'], $data['new_password']);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNewPassword(): string
    {
        return $this->newPassword;
    }
}
