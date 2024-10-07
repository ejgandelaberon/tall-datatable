<?php

namespace Emsephron\TallDatatable\Exception;

use Exception;
use Livewire\Component;

class UnimplementedHasTallDatatableInterface extends Exception
{
    public static function fromComponent(Component $component): self
    {
        return new self(sprintf(
            'Class "%s" must implement the HasTallDatatable interface.',
            get_class($component)
        ));
    }
}
