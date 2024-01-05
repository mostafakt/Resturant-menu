<?php

namespace App\Enums\Auth;

use App\Enums\Base\EnumToArray;

enum personalAccessTokenType : int
{
    use EnumToArray;

    case client = 1;
    case driver = 2;
    case investor = 3;
    case employee = 4;
}
