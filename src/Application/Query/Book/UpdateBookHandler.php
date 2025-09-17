<?php

namespace App\Application\Query\Book;

use App\Domain\BookRepositoryInterface;

class UpdateBookHandler
{
    public function __construct(private BookRepositoryInterface $repository)
    {
    }

    public function handle(array $data)
    {
        $query = UpdateBookQuery::create($data);

        return $this->repository->update($query->getId(), $query->getTitle(), $query->getAuthor(), $query->getIsbn(), $query->getPublishedDate(), $query->getCategory(), $query->getStatus(), $query->getPrice(), $query->getOwner());
    }
}
