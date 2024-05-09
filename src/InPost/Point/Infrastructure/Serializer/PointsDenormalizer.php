<?php

declare(strict_types=1);

namespace App\InPost\Point\Infrastructure\Serializer;

use App\InPost\Point\Points;
use App\InPost\Shared\Meta;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class PointsDenormalizer implements DenormalizerInterface, DenormalizerAwareInterface
{
    use DenormalizerAwareTrait;

    public function denormalize($data, $type, $format = null, array $context = []): Points
    {
        $meta = $this->denormalizer->denormalize($data['meta'], Meta::class, 'array', $context);
        $points = $this->denormalizer->denormalize($data['items'], 'App\InPost\Point\Point[]', 'array', $context);

        return Points::of($meta, ...$points);
    }

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return $type === Points::class && $format === 'json';
    }
}
