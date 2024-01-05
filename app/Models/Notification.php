<?php

namespace App\Models;

use App\Enums\Auth\personalAccessTokenType;
use App\Enums\Notification\NotificationStatus;
use App\Enums\Notification\NotificationType;
use Illuminate\Notifications\DatabaseNotification;

class Notification extends DatabaseNotification
{

    protected $primaryKey = 'id';
    protected $keyType = 'int';

    public $incrementing = true;

    public $translatable = [
        'title', 'body'
    ];

    protected $casts = [
        'read_at' => 'datetime',
        'type' => NotificationType::class,
        'user_type' => personalAccessTokenType::class,
        'status' => NotificationStatus::class,
    ];

    public function markAsPublished()
    {
        $this->forceFill(['status' => NotificationStatus::Published->value])
            ->save();
    }

    public function markAsUnpublished()
    {
        $this->forceFill(['status' => NotificationStatus::Unpublished->value])
            ->save();
    }

    public function markAsRead()
    {
        if (is_null($this->read_at)) {
            $this->forceFill([
                'status' => NotificationStatus::READ->value,
                'read_at' => $this->freshTimestamp()
            ])->save();
        }
    }


}
