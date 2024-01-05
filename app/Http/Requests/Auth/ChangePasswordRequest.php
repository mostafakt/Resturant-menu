<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Base\BaseFromRequest;

class ChangePasswordRequest extends BaseFromRequest
{
    protected array $attributesMap = [
        //'userId' => 'user_id',
    ];

    public function rules(): array
    {
        return [
            'oldPassword' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8']
        ];
    }
}
