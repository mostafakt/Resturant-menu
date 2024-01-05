<?php

namespace App\Http\Resources\Client;

use App\Http\Resources\Base\BaseJsonResource;
use App\Http\Resources\Medium\MediumLight;

class ClientLight extends BaseJsonResource
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
            'firstName' => $this->user->first_name,
            'lastName' => $this->user->last_name,
            'image' => new MediumLight($this->whenLoaded('user', function () {
                return $this->user->image;
            })),
            'mobile' => $this->user->mobile,

        ];
    }
}
