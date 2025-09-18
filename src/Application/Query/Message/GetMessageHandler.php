<?php

namespace App\Application\Query\Message;

use App\Domain\MessageRepositoryInterface;

class GetMessageHandler
{
    public function __construct(private MessageRepositoryInterface $repository) {

    }

    public function handle(array $data) {
        try {
            $query = GetMessageQuery::create($data);

            return $this->repository->get($query->getReceiverId());
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
