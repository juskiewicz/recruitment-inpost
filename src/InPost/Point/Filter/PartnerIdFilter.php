<?php

declare(strict_types=1);

namespace App\InPost\Point\Filter;

use App\InPost\Shared\Filter\AbstractFilter;

readonly class PartnerIdFilter extends AbstractFilter
{
    public const string FIELD_NAME = 'partner_id';

    public function name(): string
    {
        return static::FIELD_NAME;
    }
}
