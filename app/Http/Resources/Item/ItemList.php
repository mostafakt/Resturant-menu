<?php

namespace App\Http\Resources\Item;

use App\Http\Resources\Base\BaseJsonResource;
use App\Http\Resources\Category\CategoryLight;

class ItemList extends BaseJsonResource
{
    protected static function relations(): array
    {
        return [
            'image',
            'category',
            'discount',


        ];
    }

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'discount' => new CategoryLight($this->whenLoaded('discount')),
            'category' => new CategoryLight($this->whenLoaded('category')),

        ];
    }
}
