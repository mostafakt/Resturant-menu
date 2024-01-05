<?php

namespace App\Enums\Permission;

use App\Enums\Base\EnumToArray;

enum RoleName: string
{
    use EnumToArray;

    case SUPER_ADMIN = 'super-admin';
    case ADMIN = 'admin';
    case CLIENT = 'client';
    case Driver = 'driver';
    case INVESTOR = 'investor';
    case COLLECTION_POINT = 'collection-point';
}
