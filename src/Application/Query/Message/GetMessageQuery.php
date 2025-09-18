<?php

namespace App\Application\Query\Message;

class GetMessageQuery
{
    private $receiver_id;

    public function __construct($receiver_id)
    {
        $this->receiver_id = $receiver_id;
    }

    public static function create(array $data): static
    {
        if (!isset($data['receiver_id'])) {
            throw new \InvalidArgumentException('Receiver ID is required');
        }

        return new static($data['receiver_id']);
    }

    public function getReceiverId()
    {
        return $this->receiver_id;
    }
}
