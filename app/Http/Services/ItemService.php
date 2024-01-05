<?php

namespace App\Http\Services;

use App\Enums\Category\CategoryChildType;
use App\Models\Base\BaseModel;
use App\Models\Item;
use App\Http\Services\Base\CrudService;


class ItemService extends CrudService
{
    protected function getModelClass(): string
    {
        return Item::class;
    }

    public function create(array $data): BaseModel
    {

        $parentCategory = Item::query()->findOrFail($data['category_Id']);
        abort_if($parentCategory->category_child_type === CategoryChildType::CATEGORIES->value
            , 422, 'the parent category is only for categories');

        if ($parentCategory->category_child_type === CategoryChildType::NOT_SEY->value)
            $parentCategory->update(['category_child_type' => CategoryChildType::ITEMS->value]);

        return $this->getQuery()->create($data);
    }
}
