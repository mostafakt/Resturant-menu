<?php

namespace App\Enums\Notification;

use App\Enums\Base\EnumToArray;

enum NotificationType: int
{
    use EnumToArray;

    case VerificationCode = 1;
    case RestPassword = 2;
    case SendOtp = 3;
    case GeneralNotification = 4;
    case MedicationPackageNotification = 5;
    case OrderStatus = 6;
    case DriverPayment = 7;
    case NewOrder = 8;
    case NewBroadcastOrder = 9;
    case NewProduct = 10;
    case driverEmergey = 11;
    case newMessage = 12;

}
