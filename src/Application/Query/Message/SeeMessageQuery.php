<?php

namespace App\Application\Query\Message;

class SeeMessageQuery
{
    private int $message_id;

    public function __construct(int $message_id)
    {
        $this->message_id = $message_id;
    }

    public static function create(array $data): static
    {
        if (!isset($data['message_id'])) {
            throw new \InvalidArgumentException('Message ID is required');
        }

        return new static($data['message_id']);
    }

    public function getMessageId(): int
    {
        return $this->message_id;
    }
}
