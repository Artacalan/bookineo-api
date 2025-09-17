<?php

namespace App\Application\Query\User;

use App\Domain\UserRepositoryInterface;

class UpdateUserHandler
{

    public function __construct(private UserRepositoryInterface $repository) {

    }

    public function handle(array $data) {
        try {
            $query = UpdateUserQuery::create($data);

            return $this->repository->update_user($query->getId(), $query->getFirstName(), $query->getLastName(), $query->getEmail(), new \DateTime($query->getBirthday()));
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

}
