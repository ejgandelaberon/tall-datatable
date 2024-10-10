<?php

declare(strict_types=1);

namespace Emsephron\TallDatatable;

use Emsephron\TallDatatable\Concerns\BelongsToLivewire;
use Emsephron\TallDatatable\Concerns\CollectsPublicGetters;
use Emsephron\TallDatatable\Concerns\HasConfig;
use Emsephron\TallDatatable\Concerns\HasErrorMode;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\Support\Renderable;

class DataTable implements Htmlable
{
    use BelongsToLivewire;
    use CollectsPublicGetters;
    use HasConfig;
    use HasErrorMode;

    protected ?string $id = null;

    final private function __construct(protected HasTallDatatable $livewire)
    {
        //
    }

    public static function make(HasTallDatatable $livewire): static
    {
        return new static($livewire);
    }

    public function render(): Renderable
    {
        return view('tall-datatable::datatable', $this->collectPublicGetters());
    }

    public function toHtml(): string
    {
        return $this->render()->render();
    }

    public function getId(): ?string
    {
        return $this->id ?? $this->defaultId();
    }

    public function id(?string $id): static
    {
        $this->id = $id;

        return $this;
    }

    protected function defaultId(): string
    {
        $modelClass = class_basename($this->getLivewire()->query()->getModel());

        return str($modelClass)
            ->lower()
            ->plural()
            ->append('-table')
            ->toString();
    }
}
