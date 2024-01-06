<?php

namespace App\Http\Services;

use App\Models\Discount;
use App\Http\Services\Base\CrudService;


class DiscountService extends CrudService
{
    protected function getModelClass(): string
        {
            return Discount::class;
        }
}
