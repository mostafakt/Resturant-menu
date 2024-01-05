<?php

namespace App\Http\Requests\Category;

use App\Http\Requests\Base\BaseFromRequest;
use App\Rules\TranslationValidator;
use Illuminate\Validation\Rule;

class CategoryRequest extends BaseFromRequest
{
    protected array $attributesMap = [
        //'userId' => 'user_id',
        'mainImageId' => 'main_image_id',
        'imageId' => 'image_id',
        'grandId' => 'grand_id',
        'parentId' => 'parent_id'
    ];

    public function rules(): array
    {
        switch (request()->method()) {
            default:
            case 'POST':
                return [

                    'name' => ['required', 'string'],
                    'order' => ['int'],
                    'grandId' => ['int', Rule::exists('categories', 'id')],
                    'parentId' => ['int', Rule::exists('categories', 'id')],
                    'imageId' => ['required', Rule::exists('media', 'id')],
                    'mainImageId' => [Rule::exists('media', 'id')],

                ];
            case 'PUT':
                return [

                    'name' => ['string'],
                    'order' => ['numeric'],
                    'grandId' => ['int', Rule::exists('categories', 'id')],
                    'parentId' => ['int', Rule::exists('categories', 'id')],
                    'imageId' => [Rule::exists('media', 'id')],
                    'mainImageId' => [Rule::exists('media', 'id')],
                ];
        }
    }
}
