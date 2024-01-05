<?php

namespace App\Notifications\Auth;

use App\Enums\Notification\NotificationType;
use App\Notifications\Base\BaseNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendOtp extends BaseNotification
{
    use Queueable;

    protected string $mobile;
    protected $otpCode;

    public function __construct($mobile, $otpCode)
    {
        $this->mobile = $mobile;
        $this->otpCode = $otpCode;
    }

    public function getType(): int
    {
        return NotificationType::SendOtp->value;
    }



    public function toSms($notifiable)
    {
        return [
            'mobile' => $this->mobile,
            'title' => __('message.otp.title', locale: app()->getLocale()),
            'body' => $this->otpCode,
            'lng' => app()->getLocale() == 'ar' ? 0 : 1
        ];
    }

    public function getUserType(): int
    {
        return  1;

    }
}
