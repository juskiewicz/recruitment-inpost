<?php

declare(strict_types=1);

namespace App\Tests\Unit\InPost\Point;

use App\InPost\Point\Point;
use App\InPost\Point\Points;
use App\InPost\Shared\Meta;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(Points::class)]
class PointsTest extends TestCase
{
    #[Test]
    public function shouldBeAbleToCreatePointsInstance(): void
    {
        // Given
        $meta = new Meta(491,1,25,20);
        $items = [
            new Point('PLW01N', 'Głogowska 440'),
            new Point('POP-POR9', 'Szarotkowa 21'),
        ];

        // When
        $points = Points::of($meta, ...$items);

        // Then
        $this->assertInstanceOf(Points::class, $points);
    }

    #[Test]
    public function shouldAddPointToPointsCollection(): void
    {
        // Given
        $meta = new Meta(20, 1, 25, 1);
        $point1 = new Point('PLW01N', 'Szarotkowa 21');
        $points = Points::of($meta, $point1);
        $point2 = new Point('PLW02N', 'Szarotkowa 22');

        // When
        $updatedPoints = $points->add($point2);

        // Then
        $this->assertInstanceOf(Points::class, $updatedPoints);
        $this->assertCount(2, $updatedPoints->items->toArray());
    }

    #[Test]
    public function shouldThrowTypeErrorWhenAddingNonPointObject(): void
    {
        // Given
        $meta = new Meta(20, 1, 25, 1);
        $point1 = new Point('PLW01N', 'Szarotkowa 21');
        $points = Points::of($meta, $point1);
        $wrongType = new \stdClass();

        // Then
        $this->expectException(\TypeError::class);

        // When
        $points->add($wrongType);
    }

    #[Test]
    public function shouldConvertPointsToArray(): void
    {
        // Given
        $meta = new Meta(20, 1, 25, 1);
        $point1 = new Point('PLW01N', 'Szarotkowa 21');
        $point2 = new Point('PLW02N', 'Szarotkowa 22');
        $points = Points::of($meta, $point1, $point2);

        // Expected array
        $expectedArray = [
            'items' => [
                ['name' => 'PLW01N', 'address' => 'Szarotkowa 21'],
                ['name' => 'PLW02N', 'address' => 'Szarotkowa 22']
            ],
            'meta' => ['count' => 20, 'page' => 1, 'perPage' => 25, 'totalPages' => 1]
        ];

        // When
        $resultArray = $points->toArray();

        // Then
        $this->assertEquals($expectedArray, $resultArray);
    }
}
