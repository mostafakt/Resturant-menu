<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Base\BaseFromRequest;

class ResendVerificationCodeRequest extends BaseFromRequest
{
    protected array $attributesMap = [
        //'userId' => 'user_id',
    ];

    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'exists:users,email']
        ];
    }
}
