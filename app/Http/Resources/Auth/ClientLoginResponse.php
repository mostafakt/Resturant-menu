<?php

namespace App\Http\Resources\Auth;

use App\Http\Resources\Base\BaseJsonResource;
use App\Http\Resources\Client\ClientDetails;

class ClientLoginResponse extends BaseJsonResource
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
            'client' => new ClientDetails($this['client']),
        ];
    }

    public function toResponse($request)
    {
        if ($this['newUser']){
            return parent::toResponse($request)->setStatusCode(201);
        }
        else {
            return parent::toResponse($request)->setStatusCode(200);
        }
    }
}
