<?php

namespace App\Http\Requests\Role;

use App\Http\Requests\Base\BaseFromRequest;

class RoleExportRequest extends BaseFromRequest
{
    protected array $attributesMap = [];

    public function rules(): array
    {
        switch (request()->method()) {
            default:
            case 'POST':
                return [
                    'name' => ['required', 'boolean'],
                    'id' => ['required', 'boolean']
                ];
            case 'PUT':
                return [
                    //
                ];
        }
    }
}
