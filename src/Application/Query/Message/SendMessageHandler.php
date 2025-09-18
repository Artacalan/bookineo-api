<?php

namespace App\Application\Query\Message;

use App\Domain\MessageRepositoryInterface;

class SendMessageHandler
{
    public function __construct(private MessageRepositoryInterface $repository)
    {
    }

    public function handle(array $data)
    {
        try {
            $query = SendMessageQuery::create($data);

            return $this->repository->send($query->getSenderId(), $query->getReceiverId(), $query->getContent());
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
