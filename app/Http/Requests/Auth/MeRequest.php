<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Base\BaseFromRequest;

class MeRequest extends BaseFromRequest
{
    protected array $attributesMap = [
        //'userId' => 'user_id',
    ];

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
        ];
    }
}
