<?php

namespace App\Http\Resources\Employee;

use App\Http\Resources\Base\BaseJsonResource;
use App\Http\Resources\User\UserLight;

class EmployeeLight extends BaseJsonResource
{
    protected static function relations(): array
    {
        return [
            'user',
        ];
    }

    public function toArray($request): array
    {
        return [
            'id' => $this->user_id,
            'user' => new UserLight($this->whenLoaded('user')),
        ];
    }
}
