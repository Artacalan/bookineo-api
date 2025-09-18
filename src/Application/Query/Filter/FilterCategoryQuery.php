<?php

namespace App\Application\Query\Filter;

class FilterCategoryQuery
{
    public function __construct(private ?string $category)
    {
    }

    public static function create(array $data): self
    {
        return new self($data['category'] ?? null);
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }
}

