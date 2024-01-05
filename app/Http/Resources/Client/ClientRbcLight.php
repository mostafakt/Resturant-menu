<?php

namespace App\Http\Resources\Client;

use App\Http\Resources\Base\BaseJsonResource;

class ClientRbcLight extends BaseJsonResource
{
    protected static function relations(): array
    {
        return [

        ];
    }

    public function toArray($request): array
    {
        return [
            'id' => $this->user_id,
            //todo
        ];
    }
}
