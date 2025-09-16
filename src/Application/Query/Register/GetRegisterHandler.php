<?php

namespace App\Application\Query\Register;

use App\Domain\UserRepositoryInterface;

class GetRegisterHandler
{
    public function __construct(private UserRepositoryInterface $repository)
    {
    }

    public function handle(array $data)
    {
        $query = GetRegisterQuery::create($data);

        return $this->repository->create_user($query->getFirstName(), $query->getLastName(), $query->getEmail(), new \DateTime($query->getBirthday()), $query->getPassword());
    }
}
