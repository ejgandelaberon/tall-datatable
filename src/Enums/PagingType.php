<?php

declare(strict_types=1);

namespace Emsephron\TallDatatable\Enums;

enum PagingType: string
{
    case NUMBERS = 'numbers';
    case SIMPLE = 'simple';
    case SIMPLE_NUMBERS = 'simple_numbers';
    case FULL = 'full';
    case FULL_NUMBERS = 'full_numbers';
}
