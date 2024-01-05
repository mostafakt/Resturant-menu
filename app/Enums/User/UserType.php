<?php

namespace App\Enums\User;

use App\Enums\Base\EnumToArray;

enum UserType:string
{
    use EnumToArray;
    case Client = 'client';
    case Driver = 'driver';
    case Pharmacist = 'pharmacist';
    case Employee = 'employee';
}
