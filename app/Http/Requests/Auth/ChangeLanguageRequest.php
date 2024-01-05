<?php

namespace App\Http\Requests\Auth;

use App\Enums\Language\Language;
use App\Http\Requests\Base\BaseFromRequest;
use Illuminate\Validation\Rule;

class ChangeLanguageRequest extends BaseFromRequest
{
    protected array $attributesMap = [
        //'userId' => 'user_id',
    ];

    public function rules(): array
    {
        return [
            'language' => ['required', Rule::in(Language::values())]
        ];
    }
}
