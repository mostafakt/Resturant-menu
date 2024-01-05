<?php

namespace App\Notifications\Base;

use App\Enums\Notification\NotificationType;
use Illuminate\Notifications\Notification;

abstract class BaseNotification extends Notification
{
    public function getPriority(): string
    {
        return 'normal';
    }

    public function getTimeToLive(): int
    {
        return 241900;
    }

    abstract public function getType(): int;
    abstract public function getUserType(): int;
}
