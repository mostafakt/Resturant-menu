<?php

namespace App\Http\Resources\Employee;

use App\Http\Resources\Base\BaseJsonResource;
use App\Http\Resources\User\UserDetails;
use App\Http\Resources\User\UserLight;
use App\Http\Resources\User\UserList;

class EmployeeDetails extends BaseJsonResource
{
    protected static function relations(): array
    {
        return [
            'user',
            'createdBy',
            'updatedBy',
            'deletedBy',
        ];
    }

    public function toArray($request): array
    {
        return [
            'id' => $this->user_id,
            'address' => $this->address,
            'user' => new UserDetails($this->whenLoaded('user')),
            'createdAt' => $this->created_at,
            'createdBy' => new UserLight($this->whenLoaded('createdBy')),
            'updatedAt' => $this->updated_at,
            'updatedBy' => new UserLight($this->whenLoaded('updatedBy')),
            'deletedAt' => $this->deleted_at,
            'deletedBy' => new UserLight($this->whenLoaded('deletedBy')),
        ];
    }
}
