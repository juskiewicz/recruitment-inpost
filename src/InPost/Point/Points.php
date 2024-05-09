<?php

declare(strict_types=1);

namespace App\InPost\Point;

use App\InPost\Shared\Meta;
use Munus\Collection\GenericList;

class Points implements \JsonSerializable
{
    /**
     * @param GenericList<Point> $items
     */
    private function __construct(public GenericList $items, public Meta $meta) {}

    public static function of(Meta $meta, Point ...$points): self
    {
        return new self(GenericList::ofAll($points), $meta);
    }

    public function add(Point $point): self
    {
        return new self($this->items->append($point), $this->meta);
    }

    public function toArray(): array
    {
        return [
            'items' => $this->items->map(fn(Point $point) => $point->jsonSerialize())->toArray(),
            'meta' => $this->meta->jsonSerialize(),
        ];
    }

    public function jsonSerialize(): array
    {
        return [
            'items' => $this->items->map(fn(Point $point) => $point->jsonSerialize())->toArray(),
            'meta' => $this->meta->jsonSerialize(),
        ];
    }
}
