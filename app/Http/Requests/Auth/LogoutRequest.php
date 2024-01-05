<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Base\BaseFromRequest;

class LogoutRequest extends BaseFromRequest
{
    protected array $attributesMap = [
        //'userId' => 'user_id',
    ];

    public function rules(): array
    {
        switch (request()->method()) {
            default:
            case 'POST':
                return [
                    'logoutFromAllDevices' => ['bool', 'nullable']
                ];
            case 'PUT':
                return [
                    //
                ];
        }
    }
}
