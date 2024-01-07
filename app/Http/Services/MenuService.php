<?php

namespace App\Http\Services;

use App\Models\Menu;
use App\Http\Services\Base\CrudService;


class MenuService extends CrudService
{
    protected function getModelClass(): string
        {
            return Menu::class;
        }
}
