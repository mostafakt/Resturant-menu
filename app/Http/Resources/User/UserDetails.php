<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Base\BaseJsonResource;
use App\Http\Resources\Medium\MediumLight;
use App\Http\Resources\Role\RoleDetails;
use App\Http\Resources\Translations\TranslationsResponse;

class UserDetails extends BaseJsonResource
{
    protected static function relations(): array
    {
        return [
            'roles',
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
            $this->merge(new TranslationsResponse($this->getTranslations())),
            'image' => new MediumLight($this->whenLoaded('image')),
            'roles' => RoleDetails::collection($this->whenLoaded('roles')),
        ];
    }
}
