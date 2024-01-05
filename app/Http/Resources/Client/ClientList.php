<?php

namespace App\Http\Resources\Client;

use App\Http\Resources\Base\BaseJsonResource;
use App\Http\Resources\User\UserList;
use App\Http\Resources\City\CityLight;

class ClientList extends BaseJsonResource
{
    protected static function relations(): array
    {
        return [
            'user',
            'city',
        ];
    }

    public function toArray($request): array
    {
        return [
            'id' => $this->user_id,
            'birthDate' => $this->birth_date ? $this->birth_date->format('Y-m-d') : null,
            'activePoints' => $this->active_points,
            'expiredPoints' => $this->all_points - $this->active_points,
            'gender' => $this->gender,
            'weight' => $this->weight,
            'height' => $this->height,
            'bloodType' => $this->blood_type,
            'healthStatus' => $this->health_status,
            'user' => new UserList($this->whenLoaded('user')),
            'city' => new CityLight($this->whenLoaded('city')),
            'createdAt' => $this->created_at,
        ];
    }
}
