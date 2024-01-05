<?php

namespace App\Http\Resources\Employee;

use App\Http\Resources\Base\BaseJsonResource;
use App\Http\Resources\User\UserDetails;
use App\Http\Resources\User\UserList;

class EmployeeList extends BaseJsonResource
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
            'address' => $this->address,
            'user' => new UserDetails($this->whenLoaded('user')),
            'createdAt' => $this->created_at,
        ];
    }
}
