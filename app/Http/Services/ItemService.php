<?php

namespace App\Http\Services;

use App\Models\Item;
use App\Http\Services\Base\CrudService;


class ItemService extends CrudService
{
    protected function getModelClass(): string
        {
            return Item::class;
        }
}
