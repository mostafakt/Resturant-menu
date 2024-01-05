<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Base\BaseFromRequest;

class ResetPasswordRequest extends BaseFromRequest
{
    protected array $attributesMap = [
        'code' => 'token',
    ];

    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'exists:users,email'],
            'code' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }
}
