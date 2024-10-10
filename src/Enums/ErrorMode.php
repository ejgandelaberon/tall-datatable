<?php

namespace Emsephron\TallDatatable\Enums;

enum ErrorMode: string
{
    case Alert = 'alert';
    case Throw = 'throw';
    case None = 'none';
}
