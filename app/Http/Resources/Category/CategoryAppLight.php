<?php

namespace App\Http\Resources\Category;

use App\Http\Resources\Base\BaseJsonResource;
use App\Http\Resources\Medium\MediumLight;

class CategoryAppLight extends BaseJsonResource
{
    protected static function relations(): array
    {
        return [

            'image',
            'parent',
            'grand',
        ];
    }

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,

            'image' => new MediumLight($this->whenLoaded('image')),

            'grand' => new CategoryLight($this->whenLoaded('grand')),
            'parent' => new CategoryLight($this->whenLoaded('parent')),
        ];
    }
}
