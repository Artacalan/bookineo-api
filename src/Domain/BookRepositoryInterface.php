<?php
namespace App\Domain;
use App\Domain\Entity\Book;

Interface BookRepositoryInterface
{
    public function get();

    public function add($title, $author, $published_date, $isbn , $category, $status, $price, $owner);
}
