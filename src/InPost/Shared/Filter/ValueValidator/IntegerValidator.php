<?php

declare(strict_types=1);

namespace App\InPost\Shared\Filter\ValueValidator;

use App\InPost\Shared\Filter\ValueValidator;

class IntegerValidator implements ValueValidator
{
    public function validate(mixed ...$values): void
    {
        array_walk(
            $values,
            fn($value) => is_int($value) ?: throw new \InvalidArgumentException('All values must be integers.')
        );
    }
}
