<?php

namespace App\Domain;
use App\Domain\Entity\Rent;

interface RentRepositoryInterface
{
    public function rentBook($user_id, $book_id, $number_days_rent);
}
