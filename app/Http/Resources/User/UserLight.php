<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Base\BaseJsonResource;

class UserLight extends BaseJsonResource
{
    protected static function relations(): array
    {
        return [

        ];
    }

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
        ];
    }
}
