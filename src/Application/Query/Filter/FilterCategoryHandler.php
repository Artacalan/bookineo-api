<?php

namespace App\Application\Query\Filter;

use App\Domain\BookRepositoryInterface;

class FilterCategoryHandler
{
    public function __construct(private BookRepositoryInterface $repository)
    {
    }

    public function handle(array $category): array
    {
        $query = FilterCategoryQuery::create($category);

        return $this->repository->filterByCategory($query->getCategory());
    }
}
