<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Base\BaseFromRequest;
use Illuminate\Validation\Rule;

class DriverMeRequest extends BaseFromRequest
{
    protected array $attributesMap = [
        'cityId' => 'city_id',
        'birthDate' => 'birth_date',
        'imageId' => 'image_id',
    ];

    public function rules(): array
    {
        switch (request()->method()) {
            default:
            case 'POST':
                return [
                    //
                ];
            case 'PUT':
                return [
                    'birthDate' => ['nullable', 'date', 'date_format:Y-m-d'],
                    'address' => ['string', 'min:1', 'max:300'],
                    'wallet' => ['numeric', 'min:0', 'max:1000000'],
                    'cityId' => [Rule::exists('cities', 'id')->whereNull('deleted_at')],
                    'imageId' => [Rule::exists('media', 'id')],
                ];
        }
    }
}
