<?php

namespace App\Application\Query\User;

use App\Domain\UserRepositoryInterface;

class VerifyUserHandler
{
    public function __construct(private UserRepositoryInterface $repository)
    {
    }

    public function handle(array $data)
    {
        try {
            $query = VerifyUserQuery::create($data);

            return $this->repository->verify_user($query->getFirstName(), $query->getLastName(), $query->getEmail(), new \DateTime($query->getBirthday()));
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
