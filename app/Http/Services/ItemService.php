<?php

namespace App\Http\Services;

use App\Enums\Category\CategoryChildType;
use App\Models\Base\BaseModel;
use App\Models\Category;
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

        $parentCategory = Category::query()->findOrFail($data['category_id']);
        abort_if($parentCategory->category_child_type->value === CategoryChildType::CATEGORIES->value
            , 422, 'the parent category is only for categories');
        if (!isset($data['discount_value'])) {
            $data['discount_value'] = $parentCategory->discount_value;
        }
        if ($parentCategory->category_child_type->value === CategoryChildType::NOT_SEY->value)
            $parentCategory->update(['category_child_type' => CategoryChildType::ITEMS->value]);

        return $this->getQuery()->create($data);
    }

    public function update(mixed $id, array $data): BaseModel
    {

        $parentCategory = Category::query()->findOrFail($data['category_id']);
        abort_if($parentCategory->category_child_type->value === CategoryChildType::CATEGORIES->value
            , 422, 'the parent category is only for categories');
        if (!isset($data['discount_value'])) {
            $data['discount_value'] = $parentCategory->discount_value;
        }
        if ($parentCategory->category_child_type->value === CategoryChildType::NOT_SEY->value)
            $parentCategory->update(['category_child_type' => CategoryChildType::ITEMS->value]);

        if ($id instanceof BaseModel) {
            $id->update($data);
            return $id;
        } else {
            $model = $this->find($id);
            $model->update($data);
            return $model;
        }

    }
}
