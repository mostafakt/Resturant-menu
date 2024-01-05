<?php

namespace App\Http\Requests\Role;

use App\Http\Requests\Base\BaseFromRequest;

class RoleRequest extends BaseFromRequest
{
    protected array $attributesMap = [
        //'userId' => 'user_id',
    ];

    public function rules(): array
    {
        $roleId = request()->route('role', null)->id ?? null;

        switch (request()->method()) {
            default:
            case 'POST':
                return [
                    'name' => ['required', 'string', 'unique:roles,name'],
                    'permissions' => ['required', 'array', 'min:1'],
                    'permissions.*' => ['required', 'exists:permissions,name'],
                ];
            case 'PUT':
                return [
                    'name' => ['string', 'unique:roles,name,' . $roleId],
                    'permissions' => ['nullable', 'array', 'min:1'],
                    'permissions.*' => ['exists:permissions,name'],
                ];
        }
    }
}
