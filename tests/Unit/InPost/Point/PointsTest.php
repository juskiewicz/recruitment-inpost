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
}
