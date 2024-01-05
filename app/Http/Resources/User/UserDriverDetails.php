<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Base\BaseJsonResource;
use App\Http\Resources\City\CityLight;
use App\Http\Resources\Driver\DriverDetails;
use App\Http\Resources\Medium\MediumLight;
use App\Http\Resources\Role\RoleDetails;
use App\Http\Resources\Role\RoleList;

class UserDriverDetails extends BaseJsonResource
{
    protected static function relations(): array
    {
        return [
            'roles',
            'driver'
        ];
    }

    public function toArray($request): array
    {
        return [
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'phone' => $this->phone,
            'note' => $this->note,
            'status' => $this->status,
            'driver' => new DriverDetails($this->whenLoaded('driver')),
            'image' => new MediumLight($this->whenLoaded('logo')),
            'roles' => RoleList::collection($this->whenLoaded('roles')),
        ];
    }
}
