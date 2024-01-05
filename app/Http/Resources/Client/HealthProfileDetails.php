<?php

namespace App\Http\Resources\Client;

use App\Http\Resources\Base\BaseJsonResource;
use App\Http\Resources\ChronicDisease\ChronicDiseaseList;

class HealthProfileDetails extends BaseJsonResource
{
    protected static function relations(): array
    {
        return [
            'diseases',
        ];
    }

    public function toArray($request): array
    {
        return [
            'id' => $this->user_id,
            'weight' => $this->weight,
            'height' => $this->height,
            'bloodType' => $this->blood_type,
            'healthStatus' => $this->health_status,
            'diseases' => ChronicDiseaseList::collection($this->whenLoaded('diseases')),
        ];
    }
}
