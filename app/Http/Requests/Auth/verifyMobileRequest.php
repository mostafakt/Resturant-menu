<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Base\BaseFromRequest;

class verifyMobileRequest extends BaseFromRequest
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
                    //
                ];
            case 'PUT':
                return [
                    'code' => ['required','string','size:5']
                ];
        }
    }
}
