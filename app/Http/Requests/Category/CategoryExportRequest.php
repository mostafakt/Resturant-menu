<?php

namespace App\Http\Requests\Category;

use App\Http\Requests\Base\BaseFromRequest;

class CategoryExportRequest extends BaseFromRequest
{
    protected array $attributesMap = [];

    public function rules(): array
    {
        switch (request()->method()) {
            default:
            case 'POST':
                return [
                    'id' => ['required', 'boolean'],
                    'name' => ['required', 'boolean'],
                    'parent' => ['required', 'boolean'],
                    'order' => ['required', 'boolean']
                ];
            case 'PUT':
                return [
                    //
                ];
        }
    }
}
