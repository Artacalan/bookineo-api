<?php

namespace App\Domain;
use App\Domain\Entity\Rent;

interface RentRepositoryInterface
{
    public function get();
    public function getStillRentedBooks();
    public function rentBook($user_id, $book_id, $number_days_rent);
    public function returnBook($rent_id, $book_id, $user_id);
}
