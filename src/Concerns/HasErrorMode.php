<?php

namespace Emsephron\TallDatatable\Concerns;

use Closure;
use Emsephron\TallDatatable\Enums\ErrorMode;

trait HasErrorMode
{
    /**
     * @var string|Closure(int, string): void
     */
    protected string|Closure $errorMode = 'alert';

    public function errorMode(ErrorMode|Closure $errorMode): static
    {
        $value = $errorMode instanceof ErrorMode ? $errorMode->value : $errorMode;

        $this->errorMode = $value;

        return $this;
    }

    /**
     * @return string|Closure(int, string): void
     */
    public function getErrorMode(): string|Closure
    {
        return $this->errorMode;
    }
}
