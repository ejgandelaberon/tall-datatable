<?php

declare(strict_types=1);

namespace Emsephron\TallDatatable;

use Emsephron\TallDatatable\Concerns\BelongsToLivewire;
use Emsephron\TallDatatable\Concerns\CollectsPublicGetters;
use Emsephron\TallDatatable\Concerns\HasConfig;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;

class DataTable implements Htmlable
{
    use BelongsToLivewire;
    use CollectsPublicGetters;
    use HasConfig;

    final private function __construct(protected Component $livewire)
    {
        //
    }

    public static function make(Component $livewire): static
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
}
