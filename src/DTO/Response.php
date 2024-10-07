<?php

declare(strict_types=1);

namespace Emsephron\TallDatatable\DTO;

use Closure;
use Emsephron\TallDatatable\Columns\Column;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Response
{
    /**
     * @param  Closure[]  $rendererCallbacks
     */
    final public function __construct(
        protected AjaxData $data,
        protected Builder $query,
        protected array $rendererCallbacks = [],
    ) {}

    /**
     * @param  Closure[]  $rendererCallbacks
     */
    public static function make(AjaxData $data, Builder $query, array $rendererCallbacks = []): static
    {
        return new static($data, $query, $rendererCallbacks);
    }

    /**
     * @return array{
     *     draw: int,
     *     data: list<array<string, mixed>>,
     *     recordsTotal: int,
     *     recordsFiltered: int,
     * }
     */
    public function send(): array
    {
        $this->applySearch();
        $this->applyOrder();

        $paginator = $this->paginate();

        return [
            'draw' => $this->data->draw,
            'data' => $this->applyRenderCallbacks($paginator),
            'recordsTotal' => $paginator->total(),
            'recordsFiltered' => $paginator->total(),
        ];
    }

    protected function applySearch(): void
    {
        $search = $this->data->search;

        if ($search) {
            foreach ($this->data->columns as $column) {
                if (! $column->isSearchable()) {
                    continue;
                }

                if ($callback = $column->getSearchCallback()) {
                    $callback($this->query, $search->value);

                    continue;
                }

                $this->query->orWhereLike($column->getName(), "%{$search->value}%");
            }
        }
    }

    protected function applyOrder(): void
    {
        if ($this->data->order) {
            /** @var string[] $orderableColumns */
            $orderableColumns = collect($this->data->columns)
                ->filter(fn (Column $column): bool => $column->isOrderable())
                ->map(fn (Column $column): ?string => $column->getData())
                ->all();

            foreach ($this->data->order as $order) {
                $this->query->orderBy($orderableColumns[$order->column], $order->dir);
            }
        }
    }

    protected function paginate(): LengthAwarePaginator
    {
        $length = $this->data->length;
        $page = $this->data->start / $this->data->length + 1;

        if ($length === -1) {
            $length = $this->query->count();
            $page = 1;
        }

        return $this->query->paginate(perPage: $length, page: $page);
    }

    /**
     * @return list<array<string, mixed>>
     */
    protected function applyRenderCallbacks(LengthAwarePaginator $data): array
    {
        if ($data->isEmpty() || empty($this->rendererCallbacks)) {
            return [];
        }

        /** @var Model[] $models */
        $models = $data->items();

        /** @var list<array<string, mixed>> $formatted */
        $formatted = collect($models)->map(function (Model $model): array {
            $row = [];

            foreach ($this->data->columns as $column) {
                $value = $model->getAttribute($column->getName());

                if ($callback = $this->rendererCallbacks[$column->getData()] ?? null) {
                    $value = $callback($model, $value) ?? $value;
                }

                $row[$column->getData()] = $value;
            }

            return $row;
        })->toArray();

        return $formatted;
    }
}
