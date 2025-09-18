<?php

namespace App\Application\Query\Message;

use App\Domain\MessageRepositoryInterface;

class GetConversationHandler
{
    public function __construct(private MessageRepositoryInterface $repository)
    {

    }

    public function handle(array $data)
    {
        try {
            $query = GetConversationQuery::create($data);

            return $this->repository->get_conversation($query->getReceiverId(), $query->getSenderId());
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
