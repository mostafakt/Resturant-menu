<?php

namespace App\Http\Requests\Item;

use App\Http\Requests\Base\BaseFromRequest;
use Illuminate\Validation\Rule;

class ItemRequest extends BaseFromRequest
{
    protected array $attributesMap = [
        //'userId' => 'user_id',
        'imageId' => 'image_id',
        'categoryId' => 'category_id',
    ];

    public function rules(): array
    {
        switch (request()->method()) {
            default:
            case 'POST':
                return [
                    'categoryId' => ['int', Rule::exists('categories', 'id')],
                    'imageId' => ['required', Rule::exists('media', 'id')],

                    'name' => ['required', 'string'],

                ];
            case 'PUT':
                return [
                    'categoryId' => ['int', Rule::exists('categories', 'id')],
                    'imageId' => [Rule::exists('media', 'id')],

                    'name' => ['string'],
                ];
        }
    }
}
