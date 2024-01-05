<?php

namespace App\Http\Resources\Medium;

use App\Http\Resources\Base\BaseJsonResource;

class MediumLight extends BaseJsonResource
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
            'url' => $this->url,
            'extension' => $this->extension
        ];
    }
}
