<?php

namespace App\Http\Requests\Auth;

use App\Enums\Client\Gender;
use App\Http\Requests\Base\BaseFromRequest;
use Illuminate\Validation\Rule;

class ClientMeRequest extends BaseFromRequest
{
    protected array $attributesMap = [
        'cityId' => 'city_id',
        'firstName' => 'first_name',
        'lastName' => 'last_name',
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
                    'firstName' => ['string', 'max:50'],
                    'lastName' => ['string', 'max:50'],
                    'mobile' => ['string', 'size:9', 'regex:/^9\d{8}$/', Rule::unique('users', 'mobile')->ignore(auth()->id())],
                    'gender' => [Rule::in(Gender::values())],
                    'birthDate' => ['nullable', 'date', 'date_format:Y-m-d'],
                    'cityId' => [Rule::exists('cities', 'id')->whereNull('deleted_at')],
                    'imageId' => ['nullable', Rule::exists('media', 'id')],
                ];
        }
    }

    protected function prepareForValidation(): void
    {
        if (isset($this->mobile)) {
            $mobile = substr($this->mobile, 1);

            $data = [
                'mobile' => $mobile,
                'firstName' => $this->firstName,
                'lastName' => $this->lastName,
                'gender' => $this->gender,
                'birthDate' => $this->birthDate,
                'cityId' => $this->cityId,
                'imageId' => $this->imageId,
            ];
            $data = array_filter($data, function ($value) {
                return $value !== null;
            });
            $this->replace($data);
        }
    }
}
