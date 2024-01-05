<?php

namespace App\Http\Requests\Client;

use App\Enums\Client\BloodType;
use App\Enums\Client\Gender;
use App\Enums\User\UserStatus;
use App\Http\Requests\Base\BaseFromRequest;
use App\Rules\TranslationValidator;
use Illuminate\Validation\Rule;

class ClientRequest extends BaseFromRequest
{
    protected array $attributesMap = [
        'cityId' => 'city_id',
        'firstName' => 'first_name',
        'lastName' => 'last_name',
        'birthDate' => 'birth_date',
        'bloodType' => 'blood_type',
        'healthStatus' => 'health_status',
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
                    'firstName' => ['nullable', 'string'],
                    'lastName' => ['nullable', 'string'],
                    'mobile' => ['string', 'size:9', 'regex:/^9\d{8}$/', Rule::unique('users', 'mobile')->ignore($this->route()->client)->whereNull('deleted_at')],
                    'status' => [Rule::in(UserStatus::values())],
                    'gender' => ['nullable', Rule::in(Gender::values())],
                    'bloodType' => ['nullable', Rule::in(BloodType::values())],
                    'phone' => ['nullable', 'string', 'max:12', Rule::unique('users', 'phone')->ignore($this->route()->client)->whereNull('deleted_at')],
                    'note' => ['nullable', 'array', new TranslationValidator()],
                    'note.*' => ['nullable', 'string'],
                    'weight' => ['nullable', 'numeric'],
                    'height' => ['nullable', 'numeric'],
                    'healthStatus' => ['nullable', 'string'],
                    'birthDate' => ['nullable', 'date', 'date_format:Y-m-d'],
                    'diseaseId' => ['nullable', 'array', 'min:1'],
                    'diseaseId.*' => [Rule::exists('chronic_diseases', 'id')],
                    'cityId' => [Rule::exists('cities', 'id')->whereNull('deleted_at')],
                    'imageId' => ['nullable', Rule::exists('media', 'id')],
                ];
        }
    }

    protected function prepareForValidation(): void
    {
        if (isset($this->mobile)) {
            $mobile = $this->mobile;
            if (strpos($this->mobile, '963') === 0) {
                $mobile = substr($this->mobile, 3);
            } // Check if the string starts with '0' and remove it
            elseif (strpos($this->mobile, '0') === 0) {
                $mobile = substr($this->mobile, 1);
            }
            $data['mobile'] = $mobile;
            $data['firstName'] = $this->firstName;
            $data['lastName'] = $this->lastName;
            $data['status'] = $this->status;
            $data['gender'] = $this->gender;
            $data['bloodType'] = $this->bloodType;
            $data['phone'] = $this->phone;
            $data['note'] = $this->note;
            $data['weight'] = $this->weight;
            $data['height'] = $this->height;
            $data['birthDate'] = $this->birthDate;
            $data['cityId'] = $this->cityId;
            $data['imageId'] = $this->imageId;
            $data['healthStatus'] = $this->healthStatus;

            $data = array_filter($data, function ($value) {
                return $value !== null;
            });
            $this->replace($data);
        }
    }
}
