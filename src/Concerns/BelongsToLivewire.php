<?php

declare(strict_types=1);

namespace Emsephron\TallDatatable\Concerns;

use Emsephron\TallDatatable\HasTallDatatable;

trait BelongsToLivewire
{
    protected HasTallDatatable $livewire;

    public function livewire(HasTallDatatable $livewire): static
    {
        $this->livewire = $livewire;

        return $this;
    }

    public function getLivewire(): HasTallDatatable
    {
        return $this->livewire;
    }
}
