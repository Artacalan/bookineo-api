<?php

namespace App;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Domain\Entity\Book;

class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    public function get ()
    {
        $sql = "SELECT * FROM books";

        $connection = $this->getEntityManager()->getConnection();
        $statement = $connection->prepare($sql);
//        $statement->bindValue('seriId', $seriId);


        $result = $statement->executeQuery();
        return $result->fetchAllAssociative();
    }
}


