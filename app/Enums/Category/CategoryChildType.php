<?php

namespace App\Enums\Category;

use App\Enums\Base\EnumToArray;

enum CategoryChildType: int
{
    use EnumToArray;

    case NOT_SEY = 1;
    case ITEMS = 2;
    case CATEGORIES = 3;
}
