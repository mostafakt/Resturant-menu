<?php

namespace App\Http\Resources\Client;

use App\Http\Resources\Base\BaseJsonResource;
use App\Http\Resources\City\CityLight;
use App\Http\Resources\Medium\MediumLight;

class ClientMeDetails extends BaseJsonResource
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
            'firstName' => $this->user->first_name,
            'lastName' => $this->user->last_name,
            'mobile' => $this->user->mobile,
            'gender' => $this->user->gender,
            'activePoints' => $this->active_points,
            'expiredPoints' => $this->all_points - $this->active_points,
            'birthDate' => $this->birth_date ? $this->birth_date->format('Y-m-d') : null,
            'image' => new MediumLight($this?->user?->image),
            'city' => new CityLight($this->whenLoaded('city')),
        ];
    }
}
