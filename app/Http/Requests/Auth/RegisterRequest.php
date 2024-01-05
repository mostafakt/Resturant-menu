<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Base\BaseFromRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends BaseFromRequest
{
    protected array $attributesMap = [
        //'userId' => 'user_id',
    ];

    public function rules(): array
    {
        return [
            'mobile' => ['required', 'string', 'max:12', Rule::unique('users', 'mobile')->whereNull('deleted_at')],
        ];

    }
}
