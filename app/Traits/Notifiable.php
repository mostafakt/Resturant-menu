<?php

namespace App\Traits;

use Illuminate\Notifications\RoutesNotifications;

trait Notifiable
{
    use HasDatabaseNotification, RoutesNotifications;
}
