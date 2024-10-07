<?php

namespace Emsephron\TallDatatable\Columns\Concerns;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait CanModifySearch
{
    protected ?Closure $searchCallback = null;

    /**
     * @param  Closure(Builder<Model>, ?string): Builder<Model>  $callback
     */
    public function searchUsing(Closure $callback): static
    {
        $this->searchCallback = $callback;

        return $this;
    }

    public function getSearchCallback(): ?Closure
    {
        return $this->searchCallback;
    }
}
