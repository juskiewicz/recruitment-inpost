<?php

declare(strict_types=1);

namespace App\InPost\Point\Filter;

use App\InPost\Shared\Filter\ValueValidator;

class FilterFacade
{
    private ValueValidator $stringValidator;
    private ValueValidator $integerValidator;

    public function __construct()
    {
        $this->stringValidator = new ValueValidator\StringValidator();
        $this->integerValidator = new ValueValidator\IntegerValidator();
    }

    public function createCityFilter(...$values): CityFilter
    {
        return CityFilter::create($this->stringValidator, ...$values);
    }

    public function createNameFilter(...$values): NameFilter
    {
        return NameFilter::create($this->stringValidator, ...$values);
    }

    public function createPartnerIdFilter(...$values): PartnerIdFilter
    {
        return PartnerIdFilter::create($this->integerValidator, ...$values);
    }
}
