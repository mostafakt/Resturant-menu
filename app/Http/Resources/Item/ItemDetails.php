<?php

namespace App\Http\Resources\Item;

use App\Http\Resources\Base\BaseJsonResource;
use App\Http\Resources\Category\CategoryLight;
use App\Http\Resources\Medium\MediumLight;
use App\Http\Resources\User\UserLight;

class ItemDetails extends BaseJsonResource
{
    protected static function relations(): array
    {
        return [
            'image',
            'category',
            'discount',
            'createdBy',
            'updatedBy',
            'deletedBy',

        ];
    }

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'category' => new CategoryLight($this->whenLoaded('category')),
            'discount' => new CategoryLight($this->whenLoaded('discount')),
            'image' => new MediumLight($this->whenLoaded('image')),

            'createdAt' => $this->created_at,
            'createdBy' => new UserLight($this->whenLoaded('createdBy')),
            'updatedAt' => $this->updated_at,
            'updatedBy' => new UserLight($this->whenLoaded('updatedBy')),
            'deletedAt' => $this->deleted_at,
            'deletedBy' => new UserLight($this->whenLoaded('deletedBy')),


        ];
    }
}
