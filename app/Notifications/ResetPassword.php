<?php

namespace App\Notifications;

use App\Enums\Auth\personalAccessTokenType;
use App\Enums\Notification\NotificationType;
use App\Notifications\Base\BaseNotification;
use App\Notifications\Channels\SmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPassword extends BaseNotification
{
    use Queueable;

    private string $code;
    private int $userType;

    public function __construct(string $code)
    {
        $this->code = $code;
        $this->userType = personalAccessTokenType::employee->value;
    }

    public function getType(): int
    {
        return NotificationType::RestPassword->value;
    }

    public function getUserType(): int
    {
        return $this->userType;
    }

    public function via($notifiable): array
    {
        return [SmsChannel::class];
    }

    public function toArray($notifiable): array
    {
        return [
            //
        ];
    }
}
