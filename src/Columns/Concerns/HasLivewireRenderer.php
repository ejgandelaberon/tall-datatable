<?php

namespace Emsephron\TallDatatable\Columns\Concerns;

use Closure;

trait HasLivewireRenderer
{
    protected ?Closure $livewireRenderer = null;

    public function renderUsing(?Closure $callback): static
    {
        $this->livewireRenderer = $callback;

        return $this;
    }

    public function getLivewireRenderer(): ?Closure
    {
        return $this->livewireRenderer;
    }
}
