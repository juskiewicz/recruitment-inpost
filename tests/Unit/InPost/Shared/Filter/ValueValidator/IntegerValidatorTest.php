<?php

declare(strict_types=1);

namespace App\Tests\Unit\InPost\Shared\Filter\ValueValidator;

use App\InPost\Shared\Filter\ValueValidator\IntegerValidator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(IntegerValidator::class)]
class IntegerValidatorTest extends TestCase
{
    private IntegerValidator $validator;

    protected function setUp(): void
    {
        $this->validator = new IntegerValidator();
    }

    #[Test]
    public function testAllValuesAreValidIntegers()
    {
        // Given
        $values = [1, 2, 3, 4, 100, -100];

        // When
        // Expect no exception to be thrown
        $this->validator->validate(...$values);

        // Then
        // If no exception is thrown, the test will pass
        $this->assertTrue(true, 'All values are valid integers.');
    }

    #[Test]
    public function testAllValuesAreInvalid()
    {
        // Given
        $values = ['string', new \stdClass(), null, true, 5.5];

        // Then
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('All values must be integers.');

        // When
        $this->validator->validate(...$values);
    }

    #[Test]
    public function testSomeValuesAreValidAndSomeAreNot()
    {
        // Given
        $values = [1, 'string', 2, 4.5];

        // Then
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('All values must be integers.');

        // When
        $this->validator->validate(...$values);
    }
}
