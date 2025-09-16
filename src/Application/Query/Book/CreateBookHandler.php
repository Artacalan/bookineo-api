<?php

namespace App\Application\Query\Book;

use App\Domain\BookRepositoryInterface;

class CreateBookHandler
{
    public function __construct(private BookRepositoryInterface $repository)
    {
    }

    public function handle(array $data)
    {
        $query = CreateBookQuery::create($data);

        return $this->repository->add($query->getTitle(), $query->getAuthor(), $query->getIsbn(), $query->getPublishedDate(), $query->getCategory(), $query->getStatus(), $query->getPrice(), $query->getOwner());
    }
}
