<?php

namespace App\Enums\Client;

use App\Enums\Base\EnumToArray;

enum Gender: int
{
    use EnumToArray;

    case MALE = 1;
    case FEMALE = 2;
}
