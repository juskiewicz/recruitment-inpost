<?php

declare(strict_types=1);

namespace App\InPost\Point;

class Point implements \JsonSerializable
{
    public function __construct(
        public string $name,
        public string $address
    ) {}

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
            'address' => $this->address,
        ];
    }
}
