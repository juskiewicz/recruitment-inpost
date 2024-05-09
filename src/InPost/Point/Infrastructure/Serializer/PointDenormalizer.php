<?php

declare(strict_types=1);

namespace App\InPost\Point\Infrastructure\Serializer;

use App\InPost\Point\Point;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class PointDenormalizer implements DenormalizerInterface
{
    public function denormalize($data, $type, $format = null, array $context = []): Point
    {
        return new Point($data['name'], sprintf('%s, %s', $data['address']['line1'], $data['address']['line2']));
    }

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return $type === Point::class && $format === 'array';
    }
}
