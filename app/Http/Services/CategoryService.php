<?php

namespace App\Http\Services;

use App\Models\Category;
use App\Http\Services\Base\CrudService;


class CategoryService extends CrudService
{
    protected function getModelClass(): string
    {
        return Category::class;
    }
}
