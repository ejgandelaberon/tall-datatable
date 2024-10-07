<?php

declare(strict_types=1);

namespace Emsephron\TallDatatable;

use Emsephron\TallDatatable\DTO\AjaxData;
use Emsephron\TallDatatable\DTO\AjaxOrder;
use Emsephron\TallDatatable\DTO\AjaxSearch;
use Emsephron\TallDatatable\DTO\Response;
use Illuminate\Database\Eloquent\Builder;

trait InteractsWithDataTable
{
    protected DataTable $dataTable;

    public function bootedInteractsWithDataTable(): void
    {
        $this->dataTable = $this->dataTable(
            DataTable::make($this)
        );
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
            ->columns($this->dataTable->getColumns(false)) // @phpstan-ignore-line
            ->order(array_map(fn (array $order) => AjaxOrder::fromArray($order), $data['order']))
            ->search(AjaxSearch::fromArray($data['search']));

        return Response::make($ajaxData, $this->query())->toArray();
    }

    abstract public function query(): Builder;
}
