<?php

declare(strict_types=1);

namespace App\InPost\Point\Infrastructure;

use App\InPost\Point\Infrastructure\Factory\PointsFactory;
use App\InPost\Point\PointRepository;
use App\InPost\Point\Points;
use App\InPost\Shared\Filter\Filters;
use Symfony\Contracts\HttpClient\HttpClientInterface;

readonly class ApiPointRepository implements PointRepository
{
    public function __construct(
        private HttpClientInterface $inPostClient,
        private PointsFactory $pointsFactory,
    ) {}

    public function findWithFilters(Filters $filters): Points
    {
        $response = $this->inPostClient->request('GET', 'points', ['query' => $filters->toArray()]);

        return $this->pointsFactory->createFromResponse($response);
    }
}
