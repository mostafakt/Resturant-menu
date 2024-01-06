<?php

namespace App\Http\Resources\Discount;

use App\Http\Resources\Base\BaseJsonResource;

class DiscountList extends BaseJsonResource
{
    protected static function relations(): array
    {
        return [

        ];
    }

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'value' => $this->value,

        ];
    }
}
