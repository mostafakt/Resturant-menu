<?php

namespace App\Enums\User;

use App\Enums\Base\EnumToArray;

enum UserSlide: int
{
    use EnumToArray;

    case CLIENT = 1;
    case DRIVER = 2;
    case PHARMACISTS = 3;
    case ALL = 4;
}
