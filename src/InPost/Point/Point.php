<?php

declare(strict_types=1);

namespace App\InPost\Point;

class Point
{
    public function __construct(
        public string $name,
        public string $address
    ) {}

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'address' => $this->address,
        ];
    }
}
