<?php

namespace App\Http\Resources\Notification;

use App\Http\Resources\Base\BaseJsonResource;

class NotificationDetails extends BaseJsonResource
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
        $locale = app()->getLocale();
        return [
            'id' => $this->id,
            'title' => json_decode($this->title)->$locale,
            'body' => json_decode($this->body)->$locale,
            'type' => $this->type,
            'readAt' => $this->read_at,
            'createdAt' => $this->created_at,
            'status' => $this->status,
            'itemId' => $this->item_id,
        ];
    }
}
