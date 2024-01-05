<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Base\BaseJsonResource;
use App\Http\Resources\ChronicDisease\ChronicDiseaseList;
use App\Http\Resources\City\CityLight;
use App\Http\Resources\Client\ClientDetails;
use App\Http\Resources\Medium\MediumLight;
use App\Http\Resources\Role\RoleDetails;
use App\Http\Resources\Role\RoleLight;
use App\Http\Resources\Role\RoleList;

class UserClientDetails extends BaseJsonResource
{
    protected static function relations(): array
    {
        return [
            'roles',
            'client'
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
            'client' => new ClientDetails($this->whenLoaded('client')),
            'image' => new MediumLight($this->whenLoaded('logo')),
            'roles' => RoleList::collection($this->whenLoaded('roles')),
        ];
    }
}
