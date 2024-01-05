<?php

namespace App\Http\Requests\Auth;

use App\Enums\Client\Gender;
use App\Enums\Investor\InvestorStatus;
use App\Http\Requests\Base\BaseFromRequest;
use Illuminate\Validation\Rule;

class InvestorMeRequest extends BaseFromRequest
{
    protected array $attributesMap = [
        'cityId' => 'city_id',
        'firstName' => 'first_name',
        'lastName' => 'last_name',
        'birthDate' => 'birth_date',
        'statusInvestor' => 'status_investor',
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
                    'firstName' => ['string', 'max:50'],
                    'lastName' => ['string', 'max:50'],
                    'address' => ['string', 'max:200'],
                    'gender' => ['nullable', Rule::in(Gender::values())],
                    'statusInvestor' => [Rule::in(InvestorStatus::values())],
                    'birthDate' => ['nullable', 'date', 'date_format:Y-m-d'],
                    'cityId' => [Rule::exists('cities', 'id')->whereNull('deleted_at')],
                    'imageId' => [Rule::exists('media', 'id')],
                ];
        }
    }
}
