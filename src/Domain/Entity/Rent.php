<?php

namespace App\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'rent')]

final class Rent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    public int $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'locations')]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id', nullable: false)]
    private User $user_id;

    #[ORM\ManyToOne(targetEntity: Book::class, inversedBy: 'locations')]
    #[ORM\JoinColumn(name: 'book_id', referencedColumnName: 'id', nullable: false)]
    private Book $book_id;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeImmutable $date_start_rent;

    #[ORM\Column(type: 'integer')]
    private int $number_days_rent;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private \DateTimeImmutable $return_date;



    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): User
    {
        return $this->user_id;
    }

    public function setUserId(User $user_id): self
    {
        $this->user_id = $user_id;
        return $this;
    }

    public function getBookId(): Book
    {
        return $this->book_id;
    }

    public function setBookId(Book $book_id): self
    {
        $this->book_id = $book_id;
        return $this;
    }

    public function getDateStartRent(): \DateTimeImmutable
    {
        return $this->date_start_rent;
    }

    public function setDateStartRent(\DateTimeImmutable $date): self
    {
        $this->date_start_rent = $date;
        return $this;
    }

    public function getNumberDateRent(): int
    {
        return $this->number_days_rent;
    }

    public function setNumberDateRent(int $days): self
    {
        $this->number_days_rent = $days;
        return $this;
    }

    public function getReturnDate(): \DateTimeImmutable
    {
        return $this->return_date;
    }

    public function setReturnDate(\DateTimeImmutable $date): self
    {
        $this->return_date = $date;
        return $this;
    }
}
