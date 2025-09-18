<?php

namespace App\Application\Query\Filter;

class FilterAuthorQuery
{
    public function __construct(private string $author)
    {
    }

    public static function create(array $data): self
    {
        return new self($data['author'] ?? null);
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }
}
