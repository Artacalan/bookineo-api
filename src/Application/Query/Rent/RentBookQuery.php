<?php

namespace App\Application\Query\Rent;

class RentBookQuery
{
    private string $user_id;
    private string $book_id;
    private string $number_days_rent;

    private function __construct(int $user_id, int $book_id, string $number_days_rent)
    {
        $this->user_id = $user_id;
        $this->book_id = $book_id;
        $this->number_days_rent = $number_days_rent;
    }

    public static function create(array $data): self
    {
        return new self($data['user_id'], $data['book_id'], $data['number_days_rent']);
    }

    public function getUserId(): string
    {
        return $this->user_id;
    }
    public function getBookId(): string
    {
        return $this->book_id;
    }

    public function getNumberDaysRent(): string
    {
        return $this->number_days_rent;
    }

}
