<?php

namespace App\Http\Resources\GeneralNotification;

use App\Http\Resources\Base\BaseJsonResource;
use App\Http\Resources\User\UserLight;

class GeneralNotificationLight extends BaseJsonResource
{
    protected static function relations(): array
    {
        return [
          
        ];
    }

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title   
        ];
    }
}
