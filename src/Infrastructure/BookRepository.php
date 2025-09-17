<?php

namespace App\Infrastructure;

use App\Domain\BookRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Domain\Entity\Book;

class BookRepository extends ServiceEntityRepository implements BookRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    public function get (): array
    {
        $sql = "SELECT * FROM books";

        $connection = $this->getEntityManager()->getConnection();
        $statement = $connection->prepare($sql);
//        $statement->bindValue('seriId', $seriId);


        $result = $statement->executeQuery();
        return $result->fetchAllAssociative();
    }

    public function add($title, $author, $isbn, $published_date, $category, $status, $price, $owner): array
    {
        $sql = "INSERT INTO books (title, author, isbn, published_date, category, status, price, owner)
                VALUES (:title, :author, :isbn, :published_date , :category, :status, :price, :owner)";

        $connection = $this->getEntityManager()->getConnection();
        $statement = $connection->prepare($sql);
        $statement->bindValue('title', $title);
        $statement->bindValue('author', $author);
        $statement->bindValue('isbn', $isbn);
        $statement->bindValue('published_date', $published_date);
        $statement->bindValue('category', $category);
        $statement->bindValue('status', $status);
        $statement->bindValue('price', $price);
        $statement->bindValue('owner', $owner);

        $result = $statement->executeQuery();
        return $result->fetchAllAssociative();
    }

    public function update($id, $title, $author, $isbn, $published_date, $category, $status, $price, $owner): array
    {
        $sql = "UPDATE books SET title = :title, author = :author, isbn = :isbn, published_date = :published_date , category = :category, status = :status, price = :price, owner = :owner
                WHERE id = :id";

        $connection = $this->getEntityManager()->getConnection();
        $statement = $connection->prepare($sql);
        $statement->bindValue('title', $title);
        $statement->bindValue('author', $author);
        $statement->bindValue('isbn', $isbn);
        $statement->bindValue('published_date', $published_date);
        $statement->bindValue('category', $category);
        $statement->bindValue('status', $status);
        $statement->bindValue('price', $price);
        $statement->bindValue('owner', $owner);
        $statement->bindValue('id', $id);

        $result = $statement->executeQuery();
        return $result->fetchAllAssociative();
    }
}


