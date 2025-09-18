<?php

namespace App\Application\Query\Filter;

use App\Infrastructure\BookRepository;

class FilterPriceHandler
{
    public function __construct(private BookRepository $repository)
    {
    }

    public function handle(array $price): array
    {
        $query = FilterPriceQuery::create($price);

        return $this->repository->filterByPrice($query->getMinPrice(), $query->getMaxPrice());
    }
}
