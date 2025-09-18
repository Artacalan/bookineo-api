<?php

namespace App\Application\Query\Filter;

class FilterPriceQuery
{
    public function __construct(private ?float $minPrice, private ?float $maxPrice)
    {
    }

    public static function create(array $data): self
    {
        return new self(
            isset($data['minPrice']) ? (float)$data['minPrice'] : null,
            isset($data['maxPrice']) ? (float)$data['maxPrice'] : null
        );
    }

    public function getMinPrice(): ?float
    {
        return $this->minPrice;
    }

    public function getMaxPrice(): ?float
    {
        return $this->maxPrice;
    }
}
