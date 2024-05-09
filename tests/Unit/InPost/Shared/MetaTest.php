<?php

declare(strict_types=1);

namespace App\Tests\Unit\InPost\Shared;

use App\InPost\Shared\Meta;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(Meta::class)]
class MetaTest extends TestCase
{
    #[Test]
    public function shouldBeAbleToCreateMetaInstance(): void
    {
        // Given
        $count = 491;
        $page = 1;
        $perPage = 25;
        $totalPages = 20;

        // When
        $meta = new Meta($count, $page, $perPage, $totalPages);

        // Then
        $this->assertInstanceOf(Meta::class, $meta);
    }
}
