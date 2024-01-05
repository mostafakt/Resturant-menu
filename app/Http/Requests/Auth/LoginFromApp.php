<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Base\BaseFromRequest;
use Illuminate\Validation\Rule;

class LoginFromApp extends BaseFromRequest
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
                    'mobile' => ['required', 'string', 'size:9', 'regex:/^9\d{8}$/'],
                    'code' => ['required', 'string', 'size:5'],
                ];
            case 'PUT':
                return [
                    //
                ];
        }
    }

    protected function prepareForValidation(): void
    {
        $this->replace([
            'mobile' => substr($this->mobile, 1),
            'code' => $this->code
        ]);
    }

}
