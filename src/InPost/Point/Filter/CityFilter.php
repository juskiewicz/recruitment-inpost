<?php

declare(strict_types=1);

namespace App\InPost\Point\Filter;

use App\InPost\Shared\Filter\AbstractFilter;

readonly class CityFilter extends AbstractFilter
{
    public const string FIELD_NAME = 'city';

    public function name(): string
    {
        return static::FIELD_NAME;
    }
}
