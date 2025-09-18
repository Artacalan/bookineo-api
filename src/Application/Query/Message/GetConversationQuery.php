<?php

namespace App\Application\Query\Message;

class GetConversationQuery
{
    private int $receiver_id;
    private int $sender_id;
    public function __construct($receiver_id, $sender_id)
    {
        $this->receiver_id = $receiver_id;
        $this->sender_id = $sender_id;
    }

    public static function create(array $data): static
    {
        if (!isset($data['receiver_id']) || !isset($data['sender_id'])) {
            throw new \InvalidArgumentException('Receiver ID and Sender ID are required');
        }

        return new static($data['receiver_id'], $data['sender_id']);
    }

    public function getReceiverId(): int
    {
        return $this->receiver_id;
    }

    public function getSenderId(): int
    {
        return $this->sender_id;
    }
}
