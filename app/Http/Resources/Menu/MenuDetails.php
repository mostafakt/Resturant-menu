<?php

namespace App\Http\Resources\Menu;

use App\Http\Resources\Base\BaseJsonResource;
use App\Http\Resources\Category\CategoryLight;
use App\Http\Resources\Medium\MediumLight;
use App\Http\Resources\User\UserLight;

class MenuDetails extends BaseJsonResource
{
    protected static function relations(): array
    {
        return [
            'createdBy',
            'updatedBy',
            'deletedBy',
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
            'createdBy' => new UserLight($this->whenLoaded('createdBy')),
            'updatedAt' => $this->updated_at,
            'updatedBy' => new UserLight($this->whenLoaded('updatedBy')),
            'deletedAt' => $this->deleted_at,
            'deletedBy' => new UserLight($this->whenLoaded('deletedBy')),


        ];
    }
}
