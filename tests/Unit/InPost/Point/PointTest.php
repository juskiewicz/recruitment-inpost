<?php

declare(strict_types=1);

namespace App\Tests\Unit\InPost\Point;

use App\InPost\Point\Point;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(Point::class)]
class PointTest extends TestCase
{
    #[Test]
    public function shouldBeAbleToCreatePointInstance(): void
    {
        // Given
        $name = 'PLW01N';
        $address = 'Szarotkowa 21';

        // When
        $point = new Point($name, $address);

        // Then
        $this->assertInstanceOf(Point::class, $point);
        $this->assertEquals($name, $point->name);
        $this->assertEquals($address, $point->address);
    }

    #[Test]
    public function shouldCorrectlyConvertPointObjectToArray(): void
    {
        // Given
        $name = 'PLW01N';
        $address = 'Szarotkowa 21';
        $point = new Point($name, $address);

        // When
        $resultArray = $point->toArray();

        // Then
        $this->assertEquals(['name' => $name, 'address' => $address], $resultArray);
    }

    #[Test]
    #[DataProvider('nullInputProvider')]
    public function requiredFieldsShouldNotAcceptNullValues(string|null $name, string|null $address): void
    {
        // Given
        // Variables are passed in from the data provider

        // When
        $this->expectException(\TypeError::class);

        // Then
        new Point($name, $address);
    }

    public static function nullInputProvider(): array
    {
        return [
            'Name is null' => [null, 'Szarotkowa 21'],
            'Address is null' => ['PLW01N', null],
            'Both are null' => [null, null]
        ];
    }
}
