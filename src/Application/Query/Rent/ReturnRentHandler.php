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
        $query = ReturnRentQuery::create($data);

        try {
            $status = $this->repository->checkStatus($query->getBookId());
            if($status[0]['status'] == 1) {
                throw new \Exception("This book is already returned.");
            }

        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }

        return $this->repository->returnBook($query->getRentId(), $query->getBookId(), $query->getUserId());
    }
}
