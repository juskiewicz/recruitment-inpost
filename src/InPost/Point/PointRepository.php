<?php

declare(strict_types=1);

namespace App\InPost\Point;

use App\InPost\Shared\Filter\Filters;

interface PointRepository
{
    public function findWithFilters(Filters $filters): Points;
}
