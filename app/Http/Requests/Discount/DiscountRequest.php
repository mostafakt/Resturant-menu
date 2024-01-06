<?php

namespace App\Http\Requests\Discount;

use App\Http\Requests\Base\BaseFromRequest;

class DiscountRequest extends BaseFromRequest
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
                    'value'=>['required','string']
                    //
                ];
            case 'PUT':
                return [
                    'value'=>['string']

                ];
        }
    }
}
