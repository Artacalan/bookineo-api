<?php

namespace App\Application\Query\Message;

class SendMessageQuery
{
    private int $sender_id;
    private string $receiver_email;
    private string $content;

    public function __construct(string $receiver_email, int $sender_id, string $content)
    {
        $this->receiver_email = $receiver_email;
        $this->sender_id = $sender_id;
        $this->content = $content;
    }

    public static function create(array $data): static
    {
        if (!isset($data['receiver_email']) || !isset($data['sender_id']) || !isset($data['content'])) {
            throw new \InvalidArgumentException('Receiver ID, Sender ID and Content are required');
        }

        return new static($data['receiver_email'], $data['sender_id'], $data['content']);
    }

    public function getReceiverEmail(): string
    {
        return $this->receiver_email;
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
