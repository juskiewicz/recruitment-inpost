<?php

declare(strict_types=1);

namespace App\InPost\Shared\Filter;

interface ValueValidator
{
    public function validate(mixed ...$values): void;
}
