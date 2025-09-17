<?php
namespace App\Domain;
use App\Domain\Entity\Book;

Interface BookRepositoryInterface
{
    public function get();

    public function add($title, $author,$isbn, $published_date , $category, $status, $price, $owner);

    public function update($id, $title, $author,$isbn, $published_date , $category, $status, $price, $owner);

    public function delete($id);
}
