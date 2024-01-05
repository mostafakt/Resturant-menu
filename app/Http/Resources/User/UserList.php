<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Base\BaseJsonResource;
use App\Http\Resources\Medium\MediumLight;

class UserList extends BaseJsonResource
{
    protected static function relations(): array
    {
        return [
            'image'
        ];
    }

    public function toArray($request): array
    {
        return [
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'gender' => $this->gender,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'phone' => $this->phone,
            'note' => $this->note,
            'status' => $this->status,
            'image' => new MediumLight($this->whenLoaded('image')),
        ];
    }
}
