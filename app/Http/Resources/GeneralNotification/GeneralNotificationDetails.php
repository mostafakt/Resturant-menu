<?php

namespace App\Http\Resources\GeneralNotification;

use App\Http\Resources\Base\BaseJsonResource;
use App\Http\Resources\Product\ProductLite;
use App\Http\Resources\User\UserLight;
use App\Http\Resources\Translations\TranslationsResponse;

class GeneralNotificationDetails extends BaseJsonResource
{
    protected static function relations(): array
    {
        return [
            'product',
            'createdBy',
            'updatedBy',
            'deletedBy',
        ];
    }

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slide' => $this->slide,
            'text' => $this->text,
            'note' => $this->note,
            'product' => new ProductLite($this->whenLoaded('product')),
            $this->merge(new TranslationsResponse($this->getTranslations())),

            'createdAt' => $this->created_at,
            'createdBy' => new UserLight($this->whenLoaded('createdBy')),
            'updatedAt' => $this->updated_at,
            'updatedBy' => new UserLight($this->whenLoaded('updatedBy')),
            'deletedAt' => $this->deleted_at,
            'deletedBy' => new UserLight($this->whenLoaded('deletedBy')),
        ];
    }
}
