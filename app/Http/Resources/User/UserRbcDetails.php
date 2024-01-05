<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Base\BaseJsonResource;
use App\Http\Resources\Client\ClientRbcLight;
use App\Http\Resources\Driver\DriverRbcLight;
use App\Http\Resources\Employee\EmployeeRbcLight;
use App\Http\Resources\Investor\InvestorRbcLight;

class UserRbcDetails extends BaseJsonResource
{
    protected static function relations(): array
    {
        return [
            'employee',
            'investor',
            'driver',
            'client',
        ];
    }

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,

            'email' => $this->email,
            'mobile' => $this->mobile,
            'phone' => $this->phone,
            'client' => new ClientRbcLight($this->whenLoaded('client')),
            'investor' => new InvestorRbcLight($this->whenLoaded('investor')),
            'driver' => new DriverRbcLight($this->whenLoaded('driver')),
            'employee' => new EmployeeRbcLight($this->whenLoaded('employee')),
        ];
    }
}
