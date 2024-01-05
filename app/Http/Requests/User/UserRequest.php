<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Base\BaseFromRequest;

class UserRequest extends BaseFromRequest
{
    protected array $attributesMap = [

    ];

    public function rules(): array
    {
        switch (request()->method()) {
            default:
            case 'POST':
                return [
                    'name' => ['required', 'string'],
                    'email' => ['required', 'email'],
                    'password' => ['required', 'string', 'min:8'],
                ];
            case 'PUT':
                return [
                    'name' => ['string'],
                    'email' => ['email'],
                    'password' => ['string', 'min:8'],
                ];
        }
    }
}
