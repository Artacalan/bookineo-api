<?php

namespace App\Application\Query\Book;

class UpdateBookQuery
{
    private function __construct(
        private int $id,
        private string $title,
        private string $author,
        private string $isbn,
        private string $published_date,
        private string $category,
        private string $status,
        private float $price,
        private string $owner
    ) {
    }

    public static function create(array $data): self
    {
        return new self(
            $data['id'],
            $data['title'],
            $data['author'],
            $data['isbn'],
            $data['published_date'],
            $data['category'],
            $data['status'],
            $data['price'],
            $data['owner']
        );
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getIsbn(): string
    {
        return $this->isbn;
    }

    public function getPublishedDate(): string
    {
        return $this->published_date;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getOwner(): string
    {
        return $this->owner;
    }
}
