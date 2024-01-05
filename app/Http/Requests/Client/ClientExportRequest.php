<?php

namespace App\Http\Requests\Client;

use App\Http\Requests\Base\BaseFromRequest;

class ClientExportRequest extends BaseFromRequest
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
                    'city' => ['required', 'boolean'],
                    'mobile' => ['required', 'boolean'],
                    'createdAt' => ['required', 'boolean'],
                ];
            case 'PUT':
                return [
                    //
                ];
        }
    }
}
