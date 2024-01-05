<?php

namespace App\Http\Resources\Client;

use App\Http\Resources\Base\BaseJsonResource;
use App\Http\Resources\ChronicDisease\ChronicDiseaseList;
use App\Http\Resources\City\CityLight;
use App\Http\Resources\ClientAddress\ClientAddressList;
use App\Http\Resources\User\UserLight;
use App\Http\Resources\User\UserListWithTranslation;

class ClientDetails extends BaseJsonResource
{
    protected static function relations(): array
    {
        return [
            'user',
            'city',
            'clientAddress',
            'diseases',
            'createdBy',
            'updatedBy',
            'deletedBy',
        ];
    }

    public function toArray($request): array
    {
        return [
            'id' => $this->user_id,
            'activePoints' => $this->active_points,
            'expiredPoints' => $this->all_points - $this->active_points,
            'birthDate' => $this->birth_date ? $this->birth_date->format('Y-m-d') : null,
            'weight' => $this->weight,
            'height' => $this->height,
            'bloodType' => $this->blood_type,
            'healthStatus' => $this->health_status,
            'diseases' => ChronicDiseaseList::collection($this->whenLoaded('diseases')),
            'clientAddress' => ClientAddressList::collection($this->whenLoaded('clientAddress')),
            'user' => new UserListWithTranslation($this->whenLoaded('user')),
            'city' => new CityLight($this->whenLoaded('city')),
            'createdAt' => $this->created_at,
            'createdBy' => new UserLight($this->whenLoaded('createdBy')),
            'updatedAt' => $this->updated_at,
            'updatedBy' => new UserLight($this->whenLoaded('updatedBy')),
            'deletedAt' => $this->deleted_at,
            'deletedBy' => new UserLight($this->whenLoaded('deletedBy')),
        ];
    }
}
