<?php

declare(strict_types=1);

namespace App\Tests\Unit\InPost\Shared\Filter;

use App\InPost\Shared\Filter\Filter;
use App\InPost\Shared\Filter\Filters;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(Filters::class)]
class FiltersTest extends TestCase
{
    #[Test]
    public function printShouldReturnCorrectFormat(): void
    {
        // Given
        $cityFilter = $this->createMock(Filter::class);
        $cityFilter->method('print')->willReturn('city=Pleszew,Poznań');

        $nameFilter = $this->createMock(Filter::class);
        $nameFilter->method('print')->willReturn('name=KRA02APP');

        // When
        $filters = Filters::of($cityFilter, $nameFilter);
        $result = $filters->print();

        // Then
        $this->assertEquals('city=Pleszew,Poznań&name=KRA02APP', $result);
    }
}
