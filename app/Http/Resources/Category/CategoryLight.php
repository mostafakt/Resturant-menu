<?php

namespace App\Http\Resources\Category;

use App\Http\Resources\Base\BaseJsonResource;
use App\Http\Resources\Medium\MediumLight;

class CategoryLight extends BaseJsonResource
{
    protected static function relations(): array
    {
        return [
            'parent',
            'grand',
            'image',
            'mainImage',
        ];
    }

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => new MediumLight($this->whenLoaded('image')),
            'mainImage' => new MediumLight($this->whenLoaded('mainImage')),
            'categoryChildType' => $this->category_child_type,
            'order' => $this->order,

        ];
    }
}
