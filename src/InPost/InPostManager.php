<?php

declare(strict_types=1);

namespace App\InPost;

use App\InPost\Point\PointRepository;

readonly class InPostManager
{
    public function __construct(
        public PointRepository $points,
    ) {}
}
