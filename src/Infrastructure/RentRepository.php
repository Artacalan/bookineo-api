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

}
