<?php

namespace App\Application\Query\Filter;

use App\Domain\BookRepositoryInterface;

class SearchBookHandler
{
    public function __construct(private BookRepositoryInterface $repository)
    {
    }

    public function handle(array $criteria): array
    {
        $query = SearchBookQuery::create($criteria);

        return $this->repository->search($query->getTitle());
    }
}

