<?php

declare(strict_types=1);

namespace App\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

class CityNameTransformer implements DataTransformerInterface
{
    public function transform($value)
    {
        return $value;
    }

    public function reverseTransform($value)
    {
        if (null === $value) {
            return null;
        }

        return ucfirst(strtolower($value));
    }
}
