<?php

namespace App\Application\Query\Message;

class SendMessageQuery
{
    private int $receiver_id;
    private int $sender_id;
    private string $content;

    public function __construct(int $receiver_id, int $sender_id, string $content)
    {
        $this->receiver_id = $receiver_id;
        $this->sender_id = $sender_id;
        $this->content = $content;
    }

    public static function create(array $data): static
    {
        if (!isset($data['receiver_id']) || !isset($data['sender_id']) || !isset($data['content'])) {
            throw new \InvalidArgumentException('Receiver ID, Sender ID and Content are required');
        }

        return new static($data['receiver_id'], $data['sender_id'], $data['content']);
    }

    public function getReceiverId(): int
    {
        return $this->receiver_id;
    }

    public function getSenderId(): int
    {
        return $this->sender_id;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}
