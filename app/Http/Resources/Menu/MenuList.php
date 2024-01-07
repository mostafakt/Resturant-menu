<?php

namespace App\Http\Resources\Menu;

use App\Http\Resources\Base\BaseJsonResource;
use App\Http\Resources\Category\CategoryLight;

class MenuList extends BaseJsonResource
{
    protected static function relations(): array
    {
        return [
            'category',
        ];
    }

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'mainCategory' => new CategoryLight($this->whenLoaded('category')),
            'discountValue' => $this->discount_value,
            'createdAt' => $this->created_at,
        ];
    }
}
