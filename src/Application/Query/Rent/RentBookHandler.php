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

        try {
            $status = $this->repository->checkStatus($query->getBookId());
            if($status[0]['status'] == 0) {
                throw new \Exception("This book is not available for rent.");
            }

        } catch (\Exception $e) {
            throw new \Exception("This book is not available for rent.");
        }

        return $this->repository->rentBook($query->getUserId(), $query->getBookId(), $query->getNumberDaysRent());
    }



}
