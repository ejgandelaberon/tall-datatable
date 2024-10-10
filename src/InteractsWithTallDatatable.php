<?php

declare(strict_types=1);

namespace Emsephron\TallDatatable;

use Closure;
use Emsephron\TallDatatable\Columns\Column;
use Emsephron\TallDatatable\DTO\AjaxData;
use Emsephron\TallDatatable\DTO\AjaxOrder;
use Emsephron\TallDatatable\DTO\AjaxSearch;
use Emsephron\TallDatatable\DTO\Response;
use Emsephron\TallDatatable\Exception\UnimplementedHasTallDatatableInterface;
use Exception;
use Illuminate\Database\Eloquent\Builder;

trait InteractsWithTallDatatable
{
    protected DataTable $dataTable;

    /**
     * @var Closure(int, string): void|null
     */
    protected ?Closure $errorCallback = null;

    /**
     * @throws Exception
     */
    public function bootedInteractsWithTallDatatable(): void
    {
        if (! $this instanceof HasTallDatatable) {
            throw UnimplementedHasTallDatatableInterface::fromComponent($this);
        }

        $this->dataTable = $this->dataTable(
            DataTable::make($this)
        );

        if (($errorCallback = $this->dataTable->getErrorMode()) instanceof Closure) {
            $this->errorCallback = $errorCallback;
        }
    }

    public function dataTable(DataTable $dataTable): DataTable
    {
        return $dataTable;
    }

    public function fetch(array $data): array // @phpstan-ignore-line
    {
        $ajaxData = AjaxData::make($data['draw'])
            ->start($data['start'])
            ->length($data['length'])
            ->columns($this->getColumns())
            ->order(array_map(fn (array $order) => AjaxOrder::fromArray($order), $data['order']))
            ->search(AjaxSearch::fromArray($data['search']));

        return Response::make(
            $ajaxData,
            $this->query(),
            $this->getColumnRenderers()
        )->send();
    }

    public function handleError(int $techNote, string $message): void
    {
        if (($callback = $this->errorCallback) instanceof Closure) {
            $callback($techNote, $message);
        }
    }

    abstract public function query(): Builder;

    /**
     * @return Column[]
     */
    protected function getColumns(): array
    {
        return once(fn (): array => $this->dataTable->getColumns(false));
    }

    protected function getColumnRenderers(): array
    {
        $renderers = [];

        foreach ($this->getColumns() as $column) {
            if ($callback = $column->getLivewireRenderer()) {
                $renderers[$column->getData()] = $callback;
            }
        }

        return $renderers;
    }
}
