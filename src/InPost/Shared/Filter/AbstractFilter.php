<?php

declare(strict_types=1);

namespace App\InPost\Shared\Filter;

readonly abstract class AbstractFilter implements Filter
{
    protected function __construct(protected array $values) {}

    public static function create(ValueValidator $validator, mixed ...$values): static
    {
        $validator->validate(...$values);
        return new static($values);
    }

    public function values(): array
    {
        return $this->values;
    }

    public function print(): string
    {
        return sprintf('%s=%s', $this->name(), implode(',', $this->values));
    }
}
