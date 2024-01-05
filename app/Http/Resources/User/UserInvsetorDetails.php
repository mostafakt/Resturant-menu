<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Base\BaseJsonResource;
use App\Http\Resources\Investor\InvestorDetails;
use App\Http\Resources\Medium\MediumLight;
use App\Http\Resources\Role\RoleDetails;
use App\Http\Resources\Role\RoleList;

class UserInvsetorDetails extends BaseJsonResource
{
    protected static function relations(): array
    {
        return [
            'roles',
            'investor'
        ];
    }

    public function toArray($request): array
    {
        return [
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'phone' => $this->phone,
            'note' => $this->note,
            'status' => $this->status,
            'investor' => new InvestorDetails($this->whenLoaded('investor')),
            'image' => new MediumLight($this->whenLoaded('logo')),
            'roles' => RoleList::collection($this->whenLoaded('roles')),
        ];
    }
}
