<?php

declare(strict_types=1);

namespace App\InPost\Point\Infrastructure\Factory;

use App\InPost\Point\Points;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class PointsFactory
{
    public function __construct(private readonly SerializerInterface $serializer)
    {}

    public function createFromResponse(ResponseInterface $response): Points
    {
        return $this->serializer->deserialize($response->getContent(), Points::class, 'json');
    }
}
