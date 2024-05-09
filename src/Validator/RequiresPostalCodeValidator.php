<?php

declare(strict_types=1);

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class RequiresPostalCodeValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof RequiresPostalCode) {
            throw new UnexpectedTypeException($constraint, RequiresPostalCode::class);
        }

        if (
            false === empty($value['street'])
            && true === empty($value['postalCode'])
        ) {
            $this->context
                ->buildViolation($constraint->message)
                ->atPath('postalCode')
                ->addViolation()
            ;
        }
    }
}
