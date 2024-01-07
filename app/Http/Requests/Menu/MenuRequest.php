<?php

namespace App\Http\Requests\Menu;

use App\Http\Requests\Base\BaseFromRequest;
use Illuminate\Validation\Rule;

class MenuRequest extends BaseFromRequest
{
    protected array $attributesMap = [
        //'userId' => 'user_id',
        'mainCategoryId' => 'main_category_id',
    ];

    public function rules(): array
    {
        switch (request()->method()) {
            default:
            case 'POST':
                return [
                    //
                    'name' => ['required', 'string'],
                    'mainCategoryId' => ['required', 'int', Rule::exists('categories', 'id')],

                ];
            case 'PUT':
                return [
                    'name' => ['string'],
                    'mainCategoryId' => ['int', Rule::exists('categories', 'id')],

                ];
        }
    }
}
