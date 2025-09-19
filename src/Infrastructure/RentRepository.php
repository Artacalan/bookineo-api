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

    public function get()
    {
        // recuperer les locations et aussi les infos du livre
        $sql = "SELECT r.*, b.title, b.author, b.isbn, b.published_date, b.category, b.status, b.price, b.owner, u.first_name AS renter_first_name, u.last_name AS renter_last_name
                FROM rent r
                JOIN books b ON r.book_id = b.id
                JOIN users u ON r.user_id = u.id";
        $connection = $this->getEntityManager()->getConnection();
        $statement = $connection->prepare($sql);
        $result = $statement->executeQuery();
        return $result->fetchAllAssociative();
    }

    public function getStillRentedBooks()
    {
        $sql = "SELECT r.*, b.title, b.author, b.isbn, b.published_date, b.category, b.status, b.price, b.owner, u.first_name AS renter_first_name, u.last_name AS renter_last_name
                FROM rent r
                JOIN books b ON r.book_id = b.id
                JOIN users u ON r.user_id = u.id
                WHERE r.return_date IS NULL";

        $connection = $this->getEntityManager()->getConnection();
        $statement = $connection->prepare($sql);
        $result = $statement->executeQuery();
        return $result->fetchAllAssociative();
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
    public function returnBook($rent_id, $book_id, $user_id)
    {
        // dans la table rents, mettre la date de retour et dans la table book remettre le livre en statut disponible (0)
        $sql = "UPDATE rent SET return_date = NOW() WHERE id = :rent_id AND user_id = :user_id AND book_id = :book_id AND return_date IS NULL;
                UPDATE books SET status = 1 WHERE id = :book_id;";

        $connection = $this->getEntityManager()->getConnection();
        $statement = $connection->prepare($sql);
        $statement->bindValue('rent_id', $rent_id);
        $statement->bindValue('book_id', $book_id);
        $statement->bindValue('user_id', $user_id);
        $result = $statement->executeQuery();
        return $result->fetchAllAssociative();
    }
}
