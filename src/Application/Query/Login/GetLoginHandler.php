<?php

namespace App\Application\Query\Login;

use App\Domain\UserRepositoryInterface;

class GetLoginHandler
{
    public function __construct(private UserRepositoryInterface $repository)
    {
    }

    public function handle(array $data)
    {
        $query = GetLoginQuery::create($data);

        return $this->repository->login_user($query->getEmail(), $query->getPassword());
    }
}
