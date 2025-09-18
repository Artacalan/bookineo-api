<?php

namespace App\Application\Query\Book;

class CreateBookQuery
{
    private string $title;
    private string $author;
    private string $isbn;
    private string $published_date;
    private string $category;
    private string $status;
    private float $price;
    private string $owner;

    public function __construct(string $title, string $author, string $isbn, string $published_date, string $category, string $status, float $price, string $owner)
    {
        $this->title = $title;
        $this->author = $author;
        $this->isbn = $isbn;
        $this->published_date = $published_date;
        $this->category = $category;
        $this->status = $status;
        $this->price = $price;
        $this->owner = $owner;
    }
    public static function create(array $data)
    {
        return new static($data['title'], $data['author'], $data['isbn'], $data['published_date'], $data['category'], $data['status'] , $data['price'], $data['owner']);
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
