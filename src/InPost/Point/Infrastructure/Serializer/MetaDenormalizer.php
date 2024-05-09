<?php

declare(strict_types=1);

namespace App\InPost\Point\Infrastructure\Serializer;

use App\InPost\Shared\Meta;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class MetaDenormalizer implements DenormalizerInterface
{
    public function denormalize($data, $type, $format = null, array $context = []): Meta
    {
        return new Meta($data['count'], $data['page'], $data['per_page'], $data['total_pages']);
    }

    public function supportsDenormalization($data, $type, $format = null, array $context = []): bool
    {
        return $type === Meta::class && $format === 'array';    }
}
