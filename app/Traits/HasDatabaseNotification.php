<?php

namespace App\Traits;

use App\Models\Notification;

trait HasDatabaseNotification
{
    public function notifications(int $userType = null)
    {
        if ($userType === null){
            return $this->morphMany(Notification::class, 'notifiable')->latest();
        }
        return $this->morphMany(Notification::class, 'notifiable')
            ->where('user_type',$userType)
            ->latest();
    }

    public function readNotifications(int $userType)
    {
        return $this->notifications($userType)->read();
    }

    public function unreadNotifications(int $userType)
    {
        return $this->notifications($userType)->unread();
    }
}
