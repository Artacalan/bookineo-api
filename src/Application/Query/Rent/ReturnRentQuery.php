<?php

namespace App\Application\Query\Rent;

class ReturnRentQuery
{
    private int $rent_id;
    private int $book_id;
    private int $user_id;
    private function __construct(int $rent_id, int $book_id, int $user_id)
    {
        $this->rent_id = $rent_id;
        $this->book_id = $book_id;
        $this->user_id = $user_id;
    }

    public static function create(array $data): static
    {
        if (!isset($data['rent_id'])) {
            throw new \InvalidArgumentException('Rent ID is required');
        }
        if (!isset($data['book_id'])) {
            throw new \InvalidArgumentException('Book ID is required');
        }
        if (!isset($data['user_id'])) {
            throw new \InvalidArgumentException('User ID is required');
        }

        return new static($data['rent_id'], $data['book_id'], $data['user_id']);
    }

    public function getRentId(): int
    {
        return $this->rent_id;
    }

    public function getBookId(): int
    {
        return $this->book_id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }
}
