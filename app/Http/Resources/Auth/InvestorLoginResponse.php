<?php

namespace App\Http\Resources\Auth;

use App\Http\Resources\Base\BaseJsonResource;
use App\Http\Resources\Investor\InvestorDetails;

class InvestorLoginResponse extends BaseJsonResource
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
            'investor' => new InvestorDetails($this['investor']),
        ];
    }
}
