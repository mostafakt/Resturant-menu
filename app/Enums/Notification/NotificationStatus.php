<?php

namespace App\Enums\Notification;

use App\Enums\Base\EnumToArray;

enum NotificationStatus: int
{
    use EnumToArray;

    case Unpublished = 1;
    case Published = 2;
    case UN_READ = 3;
    case READ = 4;
}
