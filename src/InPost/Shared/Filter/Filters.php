<?php

declare(strict_types=1);

namespace App\InPost\Shared\Filter;

use Munus\Collection\GenericList;
use Munus\Collection\Stream\Collectors;

class Filters
{
    /**
     * @param GenericList<Filter> $all
     */
    private function __construct(public GenericList $all) {}

    public static function of(Filter ...$filters): self
    {
        return new self(GenericList::ofAll($filters));
    }

    public function add(Filter $filter): self
    {
        return new self($this->all->append($filter));
    }

    public function toArray(): array
    {
        return $this->all
            ->collect(Collectors::toMap(
                fn (Filter $filter) => $filter->name(),
                fn (Filter $filter) => implode(',', $filter->values())
            ))
            ->toArray()
        ;
    }

    public function print(): string
    {
        return $this->all
            ->map(fn (Filter $filter) => $filter->print())
            ->collect(Collectors::joining('&'))
        ;
    }
}
