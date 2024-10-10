<?php

namespace Emsephron\TallDatatable;

use Illuminate\Database\Eloquent\Builder;

interface HasTallDatatable
{
    public function dataTable(DataTable $dataTable): DataTable;

    public function fetch(array $data): array; // @phpstan-ignore-line

    public function query(): Builder;

    public function handleError(int $techNote, string $message): void;
}
