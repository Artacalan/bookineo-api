<?php

namespace App\Application\Query\Book;

use App\Domain\BookRepositoryInterface;

class DeleteBookHandler
{

    public function __construct(private BookRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function handle($id)
    {
        return $this->repository->delete($id);
    }
}
