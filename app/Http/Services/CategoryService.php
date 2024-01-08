<?php

namespace App\Http\Services;

use App\Enums\Category\CategoryChildType;
use App\Models\Base\BaseModel;
use App\Models\Category;
use App\Http\Services\Base\CrudService;


class CategoryService extends CrudService
{
    protected function getModelClass(): string
    {
        return Category::class;
    }

    public function create(array $data): BaseModel
    {
        if ($data['parent_id']) {
            $parentCategory = Category::query()->findOrFail($data['parent_id']);
            abort_if($parentCategory->order > 3, 422, 'you can`t add more sub categories level');
            abort_if($parentCategory->category_child_type->value === CategoryChildType::ITEMS->value
                , 422, 'the parent category is only for products');
            if (!isset($data['discount_value'])) {
                $data['discount_value'] = $parentCategory->discount_value;
            }

            $data['order'] = $parentCategory->order + 1;
            if ($parentCategory->category_child_type->value === CategoryChildType::NOT_SEY->value) {


                $parentCategory->update(['category_child_type' => CategoryChildType::CATEGORIES->value]);
            }
        } else {
            $data['order'] = 0;

        }
        return $this->getQuery()->create($data);
    }

    public function update(mixed $id, array $data): BaseModel
    {
        if ($data['parent_id']) {
            $parentCategory = Category::query()->findOrFail($data['parent_id']);
            abort_if($parentCategory->order > 3, 422, 'you can`t add more sub categories level');
            abort_if($parentCategory->category_child_type->value === CategoryChildType::ITEMS->value
                , 422, 'the parent category is only for products');
            if (!isset($data['discount_value'])) {
                $data['discount_value'] = $parentCategory->discount_value;
            }
            $data['order'] = $parentCategory->order + 1;
            if ($parentCategory->category_child_type->value === CategoryChildType::NOT_SEY->value)
                $parentCategory->update(['category_child_type' => CategoryChildType::CATEGORIES->value]);
        } else {
            $data['order'] = 0;

        }
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
