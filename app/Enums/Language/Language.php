<?php

namespace App\Enums\Language;

use App\Enums\Base\EnumToArray;

enum Language: string
{
    use EnumToArray;

    case En = 'en';
    case Ar = 'ar';
}
