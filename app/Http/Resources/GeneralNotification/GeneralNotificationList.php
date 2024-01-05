<?php

namespace App\Http\Resources\GeneralNotification;

use App\Http\Resources\Base\BaseJsonResource;
use App\Http\Resources\Product\ProductLite;
use App\Http\Resources\User\UserLight;

class GeneralNotificationList extends BaseJsonResource
{
    protected static function relations(): array
    {
        return [
            'product'
        ];
    }

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'text' => $this->text,
            'slide' => $this->slide,
            'note' => $this->note,
            'product' => new ProductLite($this->whenLoaded('product')),
        ];
    }
}
