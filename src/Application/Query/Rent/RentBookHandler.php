<?php

namespace App\Application\Query\Rent;

use App\Domain\RentRepositoryInterface;

class RentBookHandler
{
    public function __construct(private RentRepositoryInterface $repository)
    {
    }

    public function handle(array $data): array
    {
        $query = RentBookQuery::create($data);

        return $this->repository->rentBook($query->getUserId(), $query->getBookId(), $query->getNumberDaysRent());
    }



}
