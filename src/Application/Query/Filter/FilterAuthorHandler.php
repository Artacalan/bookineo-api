<?php

namespace App\Application\Query\Filter;

use App\Domain\BookRepositoryInterface;

class FilterAuthorHandler
{
    public function __construct(private BookRepositoryInterface $repository)
    {
    }

    public function handle(array $author): array
    {
        $query = FilterAuthorQuery::create($author);

        return $this->repository->filterByAuthor($query->getAuthor());
    }
}
