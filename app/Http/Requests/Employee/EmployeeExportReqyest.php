<?php

namespace App\Http\Requests\Employee;

use App\Http\Requests\Base\BaseFromRequest;

class EmployeeExportReqyest extends BaseFromRequest
{
    protected array $attributesMap = [];

    public function rules(): array
    {
        switch (request()->method()) {
            default:
            case 'POST':
                return [
                    'id' => ['required', 'boolean'],
                    'firstName' => ['required', 'boolean'],
                    'lastName' => ['required', 'boolean'],
                    'status' => ['required', 'boolean'],
                    'mobile' => ['required', 'boolean'],
                    'address' => ['required', 'boolean'],
                    'roles' => ['required', 'boolean'],
                    'createdAt' => ['required', 'boolean']
                ];
            case 'PUT':
                return [
                    //
                ];
        }
    }
}
