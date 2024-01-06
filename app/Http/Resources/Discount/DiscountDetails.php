<?php

namespace App\Http\Resources\Discount;

use App\Http\Resources\Base\BaseJsonResource;
use App\Http\Resources\User\UserLight;

class DiscountDetails extends BaseJsonResource
{
    protected static function relations(): array
    {
        return [
            'createdBy',
            'updatedBy',
            'deletedBy',
        ];
    }

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'value' => $this->value,
            'createdAt' => $this->created_at,
            'createdBy' => new UserLight($this->whenLoaded('createdBy')),
            'updatedAt' => $this->updated_at,
            'updatedBy' => new UserLight($this->whenLoaded('updatedBy')),
            'deletedAt' => $this->deleted_at,
            'deletedBy' => new UserLight($this->whenLoaded('deletedBy')),
        ];
    }
}
