<?php

namespace App\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'messages')]
final class Message
{
    // id, receiver_id, sender_id, message, seen, send_at
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(length: 36)]
    public int $id;

    #[ORM\Column]
    private int $receiver_id;

    #[ORM\Column]
    private int $sender_id;

    #[ORM\Column(type: 'text')]
    private string $content;

    #[ORM\Column]
    private int $seen;

    #[ORM\Column]
    private \DateTimeImmutable $send_at;

    public function getId(): int
    {
        return $this->id;
    }

    public function getReceiverId(): int
    {
        return $this->receiver_id;
    }

    public function setReceiverId(int $receiver_id): self
    {
        $this->receiver_id = $receiver_id;
        return $this;
    }

    public function getSenderId(): int
    {
        return $this->sender_id;
    }

    public function setSenderId(int $sender_id): self
    {
        $this->sender_id = $sender_id;
        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    public function isSeen(): bool
    {
        return $this->seen;
    }

    public function setSeen(bool $seen): self
    {
        $this->seen = $seen;
        return $this;
    }

    public function getSendAt(): \DateTimeImmutable
    {
        return $this->send_at;
    }

    public function setSendAt(\DateTimeImmutable $send_at): self
    {
        $this->send_at = $send_at;
        return $this;
    }
}
