<?php

namespace App\Http\Resources\Menu;

use App\Http\Resources\Base\BaseJsonResource;

class MenuLight extends BaseJsonResource
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
            'name' => $this->name,

        ];
    }
}
