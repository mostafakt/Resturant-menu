<?php

namespace App\Http\Services;

use App\Models\Notification;
use App\Http\Services\Base\CrudService;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class NotificationService extends CrudService
{
    protected function getModelClass(): string
    {
        return Notification::class;
    }

    public function myNotifications()
    {
        /** @var User $user */
        $user = Auth::user();
        $token = $user->currentAccessToken();
        return $user->notifications($token->type->value)
            ->orderBy('created_at', 'desc');
    }


    public function readNotification(Notification $notification)
    {
        $notification->markAsRead();

        return $notification;
    }

}
