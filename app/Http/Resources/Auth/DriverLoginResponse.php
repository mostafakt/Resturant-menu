<?php

namespace App\Http\Resources\Auth;

use App\Http\Resources\Base\BaseJsonResource;
use App\Http\Resources\Driver\DriverDetails;

class DriverLoginResponse extends BaseJsonResource
{
    protected static function relations(): array
    {
        return [

        ];
    }

    public function toArray($request): array
    {
        return [
            'token' => $this['token'],
            'driver' => new DriverDetails($this['driver']),
        ];
    }
}
