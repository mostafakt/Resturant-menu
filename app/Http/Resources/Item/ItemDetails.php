<?php

namespace App\Http\Resources\Item;

use App\Http\Resources\Base\BaseJsonResource;

class ItemDetails extends BaseJsonResource
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

        ];
    }
}
