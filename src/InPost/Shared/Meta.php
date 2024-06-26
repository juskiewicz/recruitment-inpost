<?php

declare(strict_types=1);

namespace App\InPost\Shared;

readonly class Meta
{
    public function __construct(
        public int $count,
        public int $page,
        public int $perPage,
        public int $totalPages,
    ) {}

    public function toArray(): array
    {
        return [
            'count' => $this->count,
            'page' => $this->page,
            'perPage' => $this->perPage,
            'totalPages' => $this->totalPages,
        ];
    }
}
