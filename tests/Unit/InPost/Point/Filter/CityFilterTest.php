<?php

declare(strict_types=1);

namespace App\Tests\Unit\InPost\Point\Filter;

use App\InPost\Point\Filter\CityFilter;
use App\InPost\Shared\Filter\ValueValidator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(CityFilter::class)]
class CityFilterTest extends TestCase
{
    private ValueValidator $stringValidator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->stringValidator = new ValueValidator\StringValidator();
    }

    #[Test]
    public function shouldBeAbleToCreateCityFilterInstance(): void
    {
        // Given
        $values = ['Pleszew', 'Poznań'];

        // When
        $cityFilter = CityFilter::create($this->stringValidator, ...$values);

        // Then
        $this->assertInstanceOf(CityFilter::class, $cityFilter);
        $this->assertEquals($values, $cityFilter->values());
    }

    #[Test]
    public function printShouldReturnCorrectFormat(): void
    {
        // Given
        $values = ['Pleszew', 'Poznań'];
        $expectedString = 'city=Pleszew,Poznań';

        // When
        $cityFilter = CityFilter::create($this->stringValidator, ...$values);
        $resultString = $cityFilter->print();

        // Then
        $this->assertSame($expectedString, $resultString);
    }

    #[Test]
    #[DataProvider('invalidValuesProvider')]
    public function shouldThrowInvalidArgumentExceptionIfNonStringValuesArePassed(mixed $invalidValue): void
    {
        // Given
        // Invalid value provided by data provider

        // Then
        $this->expectException(\InvalidArgumentException::class);

        // When
        CityFilter::create($this->stringValidator, $invalidValue);
    }

    public static function invalidValuesProvider(): array
    {
        return [
            [123],
            [new \stdClass()],
            [null],
            [45.67],
            [true],
            [array()],
        ];
    }
}
