<?php

declare(strict_types=1);

namespace Emsephron\TallDatatable\DTO;

use Emsephron\TallDatatable\Columns\Column;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @implements Arrayable<string, mixed>
 */
class Response implements Arrayable
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function __construct(
        public int $draw,
        public array $data,
        public int $recordsTotal,
        public int $recordsFiltered,
    ) {}

    public function toArray(): array
    {
        return [
            'draw' => $this->draw,
            'data' => $this->data,
            'recordsTotal' => $this->recordsTotal,
            'recordsFiltered' => $this->recordsFiltered,
        ];
    }

    public static function make(AjaxData $data, Builder $query): self
    {
        static::applySearch($query, $data);
        static::applyOrder($query, $data);

        $paginator = static::paginate($query, $data);

        return new self(
            draw: $data->draw,
            data: collect($paginator->items())->toArray(),
            recordsTotal: $paginator->total(),
            recordsFiltered: $paginator->total(),
        );
    }

    /**
     * @param  Builder<Model>  $query
     */
    protected static function applySearch(Builder $query, AjaxData $request): void
    {
        if ($request->search?->value) {
            foreach ($request->columns as $column) {
                if (! $column->isSearchable()) {
                    continue;
                }

                if ($callback = $column->getSearchCallback()) {
                    $callback($query, $request->search->value);

                    continue;
                }

                $query->orWhereLike($column->getName(), "%{$request->search->value}%");
            }
        }
    }

    /**
     * @param  Builder<Model>  $query
     */
    protected static function applyOrder(Builder $query, AjaxData $request): void
    {
        if ($request->order) {
            /** @var string[] $orderableColumns */
            $orderableColumns = collect($request->columns)
                ->filter(fn (Column $column): bool => $column->isOrderable())
                ->map(fn (Column $column): ?string => $column->getData())
                ->all();

            foreach ($request->order as $order) {
                $query->orderBy($orderableColumns[$order->column], $order->dir);
            }
        }
    }

    /**
     * @param  Builder<Model>  $query
     * @return LengthAwarePaginator<Model>
     */
    protected static function paginate(Builder $query, AjaxData $request): LengthAwarePaginator
    {
        $length = $request->length;
        $page = $request->start / $request->length + 1;

        if ($length === -1) {
            $length = $query->count();
            $page = 1;
        }

        return $query->paginate(perPage: $length, page: $page);
    }
}
