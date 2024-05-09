<?php

declare(strict_types=1);

namespace App\Tests\Unit\InPost\Shared\Filter\ValueValidator;

use App\InPost\Shared\Filter\ValueValidator\StringValidator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(StringValidator::class)]
class StringValidatorTest extends TestCase
{
    private StringValidator $validator;

    protected function setUp(): void
    {
        $this->validator = new StringValidator();
    }

    #[Test]
    public function testAllValuesAreValidStrings()
    {
        // Given
        $values = ['hello', 'world', 'PHP', 'PHPUnit'];

        // When
        // Expect no exception to be thrown
        $this->validator->validate(...$values);

        // Then
        // If no exception is thrown, the test will pass
        $this->assertTrue(true, 'All values are valid strings.');
    }

    #[Test]
    public function testAllValuesAreInvalid()
    {
        // Given
        $values = [123, new \stdClass(), null, true];

        // Then
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('All values must be strings.');

        // When
        $this->validator->validate(...$values);
    }

    #[Test]
    public function testSomeValuesAreValidAndSomeAreNot()
    {
        // Given
        $values = ['PHP', 123, 'PHPUnit', new \stdClass()];

        // Then
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('All values must be strings.');

        // When
        $this->validator->validate(...$values);
    }
}
