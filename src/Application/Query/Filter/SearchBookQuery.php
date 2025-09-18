<?php

namespace App\Application\Query\Filter;

use App\Domain\BookRepositoryInterface;
use App\Domain\Entity\Book;

class SearchBookQuery
{
    private function __construct(private string $title)
    {
    }

    public static function create(array $data): self
    {
        return new self($data['title'] ?? null);
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }
}
