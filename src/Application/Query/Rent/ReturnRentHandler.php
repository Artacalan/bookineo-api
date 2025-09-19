<?php

namespace App\Application\Query\Rent;

use App\Domain\RentRepositoryInterface;

class ReturnRentHandler
{
    public function __construct(private RentRepositoryInterface $repository)
    {

    }

    public function handle(array $data)
    {
        try {
            $query = ReturnRentQuery::create($data);

            return $this->repository->returnBook($query->getRentId(), $query->getBookId(), $query->getUserId());
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
