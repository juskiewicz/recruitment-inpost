<?php

declare(strict_types=1);

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

class RequiresPostalCode extends Constraint
{
    public string $message = 'Postal code is required when street is provided.';
}
