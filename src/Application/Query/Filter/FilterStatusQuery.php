<?php

namespace App\Application\Query\Filter;

class FilterStatusQuery
{
    public function __construct(private int $status)
    {
    }

    public static function create(array $status): self
    {
        if (!isset($status['status'])) {
            throw new \InvalidArgumentException('Invalid status value. Allowed values are 0, 1, or 2.');
        }
        return new self($status['status']);
    }

    public function getStatus(): int
    {
        return $this->status;
    }
}
