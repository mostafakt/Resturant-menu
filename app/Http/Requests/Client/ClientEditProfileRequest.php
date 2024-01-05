<?php

namespace App\Http\Requests\Client;

use App\Enums\Client\Gender;
use App\Http\Requests\Base\BaseFromRequest;
use Illuminate\Validation\Rule;
use App\Enums\Client\BloodType;
use App\Rules\TranslationValidator;

class ClientEditProfileRequest extends BaseFromRequest
{
    protected array $attributesMap = [
        'bloodType' => 'blood_type',
        'healthStatus' => 'health_status',
    ];

    public function rules(): array
    {
        switch (request()->method()) {
            default:
            case 'POST':
                return [];
            case 'PUT':
                return [
                    'weight' => ['nullable', 'numeric'],
                    'height' => ['nullable', 'numeric'],
                    'bloodType' => [Rule::in(BloodType::values())],
                    'healthStatus' => ['nullable', 'string'],
                    'diseaseId.*' => [Rule::exists('chronic_diseases','id')->whereNull('deleted_at')],
                ];
        }
    }
}
