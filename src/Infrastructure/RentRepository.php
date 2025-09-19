<?php

namespace App\Infrastructure;

use App\Domain\Entity\Book;
use App\Domain\Entity\Rent;
use App\Domain\RentRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class RentRepository extends ServiceEntityRepository implements RentRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rent::class);
    }

    public function rentBook($user_id, $book_id, $number_days_rent)
    {
        $sql = "INSERT INTO rent (user_id, book_id, number_days_rent)
                VALUES (:user_id, :book_id, :number_days_rent);
                UPDATE books SET status = 0 WHERE id = :book_id";

        $connection = $this->getEntityManager()->getConnection();
        $statement = $connection->prepare($sql);
        $statement->bindValue('user_id', $user_id);
        $statement->bindValue('book_id', $book_id);
        $statement->bindValue('number_days_rent', $number_days_rent);

        $result = $statement->executeQuery();
        return $result->fetchAllAssociative();
    }
}
