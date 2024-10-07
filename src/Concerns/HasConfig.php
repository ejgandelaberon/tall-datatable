<?php

declare(strict_types=1);

namespace Emsephron\TallDatatable\Concerns;

use Emsephron\TallDatatable\Column;
use Emsephron\TallDatatable\DTO\ConfigRenderer;
use Emsephron\TallDatatable\DTO\ConfigSearch;
use Emsephron\TallDatatable\Enums\PagingType;

trait HasConfig
{
    /**
     * @var array<string, mixed>
     */
    protected array $ajaxData = [];

    protected bool $autoWidth = true;

    protected ?string $caption = null;

    /**
     * @var Column[]
     */
    protected array $columns = [];

    /**
     * @var array<array-key, mixed>
     */
    protected array $data = [];

    /** @var int|int[]|null */
    protected int|array|null $deferLoading = null;

    protected bool $deferRender = false;

    protected bool $destroy = false;

    protected ?int $displayStart = null;

    protected bool $info = true;

    protected bool $lengthChange = true;

    /**
     * @var int[]
     */
    protected array $lengthMenu = [10, 25, 50, 100];

    /**
     * @var array<int, int|string|array<int, int|string>>
     */
    protected array $order = [];

    protected bool $ordering = true;

    protected bool $orderMulti = false;

    protected ?int $pageLength = null;

    protected bool $paging = true;

    protected ?string $pagingType = null;

    protected bool $processing = true;

    protected string|ConfigRenderer|null $renderer = null;

    protected bool $retrieve = false;

    protected ?string $rowId = null;

    protected bool $scrollCollapse = false;

    protected bool $scrollX = false;

    protected ?string $scrollY = null;

    protected bool|ConfigSearch|null $search = null;

    /**
     * @var ConfigSearch[]|null
     */
    protected ?array $searchCols = null;

    protected ?int $searchDelay = null;

    protected bool $searching = true;

    protected bool $serverSide = true;

    /**
     * @param  array<array-key, mixed>  $data
     */
    public function data(array $data): static
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @param  Column[]  $columns
     */
    public function columns(array $columns): static
    {
        $this->columns = $columns;

        return $this;
    }

    /**
     * @return array<array-key, mixed>
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @return ($raw is true ? array<string, mixed> : Column[])
     */
    public function getColumns(bool $raw = true): array
    {
        if (! $raw) {
            return $this->columns;
        }

        return array_map(fn (Column $column): array => $column->toArray(), $this->columns);
    }

    /**
     * @param  array<string, mixed>  $ajaxData
     */
    public function ajaxData(array $ajaxData): static
    {
        $this->ajaxData = $ajaxData;

        return $this;
    }

    /**
     * @return array<string, mixed>
     */
    public function getAjaxData(): array
    {
        return $this->ajaxData;
    }

    public function autoWidth(bool $autoWidth = true): static
    {
        $this->autoWidth = $autoWidth;

        return $this;
    }

    public function getAutoWidth(): bool
    {
        return $this->autoWidth;
    }

    public function caption(?string $caption): static
    {
        $this->caption = $caption;

        return $this;
    }

    public function getCaption(): ?string
    {
        return $this->caption;
    }

    /**
     * @return int[]|int|null
     */
    public function getDeferLoading(): array|int|null
    {
        return $this->deferLoading;
    }

    /**
     * @param  int[]|int|null  $deferLoading
     */
    public function deferLoading(array|int|null $deferLoading): static
    {
        $this->deferLoading = $deferLoading;

        return $this;
    }

    public function getDeferRender(): bool
    {
        return $this->deferRender;
    }

    public function deferRender(bool $deferRender = true): static
    {
        $this->deferRender = $deferRender;

        return $this;
    }

    public function destroy(bool $destroy = true): static
    {
        $this->destroy = $destroy;

        return $this;
    }

    public function getDestroy(): bool
    {
        return $this->destroy;
    }

    public function getDisplayStart(): ?int
    {
        return $this->displayStart;
    }

    public function displayStart(?int $displayStart): static
    {
        $this->displayStart = $displayStart;

        return $this;
    }

    public function getInfo(): bool
    {
        return $this->info;
    }

    public function info(bool $info = true): static
    {
        $this->info = $info;

        return $this;
    }

    public function getLengthChange(): bool
    {
        return $this->lengthChange;
    }

    public function setLengthChange(bool $lengthChange): static
    {
        $this->lengthChange = $lengthChange;

        return $this;
    }

    /**
     * @return int[]
     */
    public function getLengthMenu(): array
    {
        return $this->lengthMenu;
    }

    /**
     * @param  int[]  $lengthMenu
     */
    public function setLengthMenu(array $lengthMenu): static
    {
        $this->lengthMenu = $lengthMenu;

        return $this;
    }

    /**
     * @return array<int, int|string|array<int, int|string>>
     */
    public function getOrder(): array
    {
        return $this->order;
    }

    /**
     * @param  array<int, int|string|array<int, int|string>>  $order
     */
    public function order(array $order): static
    {
        $this->order = $order;

        return $this;
    }

    public function getOrdering(): bool
    {
        return $this->ordering;
    }

    public function ordering(bool $ordering = true): static
    {
        $this->ordering = $ordering;

        return $this;
    }

    public function getOrderMulti(): bool
    {
        return $this->orderMulti;
    }

    public function orderMulti(bool $orderMulti = true): static
    {
        $this->orderMulti = $orderMulti;

        return $this;
    }

    public function getPageLength(): ?int
    {
        return $this->pageLength;
    }

    public function pageLength(?int $pageLength): static
    {
        $this->pageLength = $pageLength;

        return $this;
    }

    public function getPaging(): bool
    {
        return $this->paging;
    }

    public function paging(bool $paging = true): static
    {
        $this->paging = $paging;

        return $this;
    }

    public function getPagingType(): ?string
    {
        return $this->pagingType;
    }

    public function pagingType(?PagingType $pagingType): static
    {
        $this->pagingType = $pagingType?->value;

        return $this;
    }

    public function getProcessing(): bool
    {
        return $this->processing;
    }

    public function processing(bool $processing = true): static
    {
        $this->processing = $processing;

        return $this;
    }

    /**
     * @return array<string, ?string>|string|null
     */
    public function getRenderer(): array|string|null
    {
        if ($this->renderer instanceof ConfigRenderer) {
            return $this->renderer->toArray();
        }

        return $this->renderer;
    }

    public function renderer(ConfigRenderer|string|null $renderer): static
    {
        $this->renderer = $renderer;

        return $this;
    }

    public function getRetrieve(): bool
    {
        return $this->retrieve;
    }

    public function retrieve(bool $retrieve = true): static
    {
        $this->retrieve = $retrieve;

        return $this;
    }

    public function getRowId(): ?string
    {
        return $this->rowId;
    }

    public function rowId(?string $rowId): static
    {
        $this->rowId = $rowId;

        return $this;
    }

    public function getScrollCollapse(): bool
    {
        return $this->scrollCollapse;
    }

    public function scrollCollapse(bool $scrollCollapse = true): static
    {
        $this->scrollCollapse = $scrollCollapse;

        return $this;
    }

    public function getScrollX(): bool
    {
        return $this->scrollX;
    }

    public function scrollX(bool $scrollX = true): static
    {
        $this->scrollX = $scrollX;

        return $this;
    }

    public function getScrollY(): ?string
    {
        return $this->scrollY;
    }

    public function scrollY(?string $scrollY): static
    {
        $this->scrollY = $scrollY;

        return $this;
    }

    /**
     * @return array<string, bool|string|null>|bool|null
     */
    public function getSearch(): array|bool|null
    {
        if ($this->search instanceof ConfigSearch) {
            return $this->search->toArray();
        }

        return $this->search;
    }

    public function search(ConfigSearch|bool|null $search = true): static
    {
        $this->search = $search;

        return $this;
    }

    /**
     * @return array<int, array<string, bool|string|null>>|null
     */
    public function getSearchCols(): ?array
    {
        if (! $this->searchCols) {
            return null;
        }

        return array_map(fn (ConfigSearch $search): array => $search->toArray(), $this->searchCols);
    }

    /**
     * @param  ConfigSearch[]|null  $searchCols
     */
    public function setSearchCols(?array $searchCols): static
    {
        $this->searchCols = $searchCols;

        return $this;
    }

    public function getSearchDelay(): ?int
    {
        return $this->searchDelay;
    }

    public function searchDelay(?int $searchDelay): static
    {
        $this->searchDelay = $searchDelay;

        return $this;
    }

    public function getSearching(): bool
    {
        return $this->searching;
    }

    public function searching(bool $searching = true): static
    {
        $this->searching = $searching;

        return $this;
    }

    public function getServerSide(): bool
    {
        return $this->serverSide;
    }

    public function serverSide(bool $serverSide = true): static
    {
        $this->serverSide = $serverSide;

        return $this;
    }
}
