<?php

namespace App\Application\Query\User;

use App\Domain\UserRepositoryInterface;

class ChangePasswordHandler
{
    public function __construct(private UserRepositoryInterface $repository)
    {
    }

    public function handle(array $data)
    {
        try {
            $query = ChangePasswordQuery::create($data);

            return $this->repository->change_password($query->getId(), $query->getNewPassword());
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
