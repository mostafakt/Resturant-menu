<?php

namespace App\Http\Resources\Category;

use App\Enums\Category\CategoryChildType;
use App\Http\Resources\Base\BaseJsonResource;
use App\Http\Resources\Item\ItemLight;
use App\Http\Resources\Medium\MediumLight;
use App\Http\Resources\User\UserLight;
use App\Models\Category;

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

    function childesType()
    {
//        if ($this->category_child_type === CategoryChildType::ITEMS->value)
//            return ItemLight::collection($this->childes());
//        else
//            return CategoryLight::collection($this->childes());
        return $this->childes();
    }

    public function toArray($request): array
    {

        return [
            'id' => $this->id,
            'name' => $this->name,
            'discountValue' => $this->discount_value,
            'childes' => $this->childesType(),

            'parent' => new CategoryLight($this->whenLoaded('parent')),
            'order' => $this->order,
            'categoryChildType' => $this->category_child_type,

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
