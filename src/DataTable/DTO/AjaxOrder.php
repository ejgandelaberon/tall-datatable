<?php

declare(strict_types=1);

namespace Emsephron\TallDatatable\DataTable\DTO;

use Illuminate\Contracts\Support\Arrayable;

/**
 * @implements Arrayable<string, mixed>
 */
class AjaxOrder implements Arrayable
{
    public function __construct(
        public int $column,
        public string $dir,
        public ?string $name,
    ) {}

    /**
     * @param  array<string, string|int|null>  $order
     */
    public static function fromArray(array $order): self
    {
        return new self(
            column: (int) $order['column'],
            dir: strval($order['dir']),
            name: $order['name'] ? strval($order['name']) : null,
        );
    }

    /**
     * @return array<string, string|int|null>
     */
    public function toArray(): array
    {
        return [
            'column' => $this->column,
            'dir' => $this->dir,
            'name' => $this->name,
        ];
    }
}
