<?php

namespace App\Application\Query\Book;


use App\Domain\BookRepositoryInterface;

class GetBooksHandler
{
    public function __construct(private BookRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function handle(): array
    {
        return $this->repository->get();
    }
}
