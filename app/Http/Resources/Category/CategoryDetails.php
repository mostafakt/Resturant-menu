<?php

namespace App\Http\Resources\Category;

use App\Http\Resources\Base\BaseJsonResource;
use App\Http\Resources\Medium\MediumLight;
use App\Http\Resources\User\UserLight;

class CategoryDetails extends BaseJsonResource
{
    protected static function relations(): array
    {
        return [
            'parent',
            'grand',
            'createdBy',
            'updatedBy',
            'deletedBy',
            'image',
            'mainImage',
        ];
    }

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'childes' => $this->childes(),

            'parent' => new CategoryLight($this->whenLoaded('parent')),
            'order' => $this->order,
            'category_child_type' => $this->category_child_type,

            'image' => new MediumLight($this->whenLoaded('image')),
            'mainImage' => new MediumLight($this->whenLoaded('mainImage')),



            'createdAt' => $this->created_at,
            'createdBy' => new UserLight($this->whenLoaded('createdBy')),
            'updatedAt' => $this->updated_at,
            'updatedBy' => new UserLight($this->whenLoaded('updatedBy')),
            'deletedAt' => $this->deleted_at,
            'deletedBy' => new UserLight($this->whenLoaded('deletedBy')),

        ];
    }
}
