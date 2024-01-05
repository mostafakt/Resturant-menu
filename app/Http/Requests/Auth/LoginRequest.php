<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Base\BaseFromRequest;

class LoginRequest extends BaseFromRequest
{
    protected array $attributesMap = [
        //'userId' => 'user_id',
    ];

    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'exists:users,email','max:100'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }
}
