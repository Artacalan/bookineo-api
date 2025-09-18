<?php

namespace App\Application\Query\Filter;

use App\Domain\BookRepositoryInterface;

class FilterStatusHandler
{
    public function __construct(private BookRepositoryInterface $repository)
    {
    }

    public function handle(array $status): array
    {
        $query = FilterStatusQuery::create($status);

        return $this->repository->filterByStatus($query->getStatus());
    }
}
