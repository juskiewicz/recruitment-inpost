<?php

declare(strict_types=1);

namespace App\InPost\Shared\Filter;

interface Filter
{
    public static function create(ValueValidator $validator, ...$values): self;
    public function name(): string;
    public function values(): array;
    public function print(): string;
}
