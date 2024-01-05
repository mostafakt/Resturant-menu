<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Base\BaseJsonResource;
use App\Http\Resources\Employee\EmployeeDetails;
use App\Http\Resources\Employee\EmployeeLight;
use App\Http\Resources\Medium\MediumLight;
use App\Http\Resources\Role\RoleDetails;
use App\Http\Resources\Role\RoleList;

class UserEmployeeDetails extends BaseJsonResource
{
    protected static function relations(): array
    {
        return [
            'roles',
            'employee'
        ];
    }

    public function toArray($request): array
    {
        return [
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'gender' => $this->gender,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'phone' => $this->phone,
            'note' => $this->note,
            'status' => $this->status,
            'employee' => new EmployeeLight($this->whenLoaded('employee')),
            'permissions' => $this->getAllPermissions()->pluck('name'),
            'image' => new MediumLight($this->whenLoaded('logo')),
            'roles' => RoleList::collection($this->whenLoaded('roles')),
        ];
    }
}
