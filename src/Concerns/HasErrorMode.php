<?php

namespace Emsephron\TallDatatable\Concerns;

use Emsephron\TallDatatable\Enums\ErrorMode;

trait HasErrorMode
{
    protected string $errorMode = 'alert';

    public function errorMode(ErrorMode $errorMode): static
    {
        $this->errorMode = $errorMode->value;

        return $this;
    }

    public function getErrorMode(): string
    {
        return $this->errorMode;
    }
}
