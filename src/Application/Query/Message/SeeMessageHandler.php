<?php

namespace App\Application\Query\Message;

use App\Domain\MessageRepositoryInterface;

class SeeMessageHandler
{
    public function __construct(private MessageRepositoryInterface $repository) {

    }

    public function handle(array $data) {
        try {
            $query = SeeMessageQuery::create($data);

            return $this->repository->seen($query->getMessageId());
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
