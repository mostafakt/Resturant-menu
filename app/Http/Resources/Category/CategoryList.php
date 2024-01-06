<?php

namespace App\Http\Resources\Category;

use App\Http\Resources\Base\BaseJsonResource;
use App\Http\Resources\Medium\MediumLight;

class CategoryList extends BaseJsonResource
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
            'mainImage' => new MediumLight($this->whenLoaded('mainImage')),
            'discountValue' => $this->discount_value,

            'parent' => new CategoryLight($this->whenLoaded('parent')),
            'order' => $this->order,
            'image' => new MediumLight($this->whenLoaded('image')),

            'createdAt' => $this->created_at,

        ];
    }
}
