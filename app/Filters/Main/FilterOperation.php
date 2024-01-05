<?php

namespace App\Filters\Main;

use App\Enums\Base\EnumToArray;

enum FilterOperation: string
{
    use EnumToArray;

    case Like = 'like';
    case EQ = 'eq';
    case NEQ = 'neq';
    case GT = 'gt';
    case GTE = 'gte';
    case LT = 'lt';
    case LTE = 'lte';
    case In = 'in';
    case Include = 'include';
    case NotIn = 'not-in';
}
