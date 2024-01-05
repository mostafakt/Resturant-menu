<?php

namespace App\Http\Requests\Employee;

use App\Enums\Permission\RoleName;
use App\Enums\User\UserStatus;
use App\Http\Requests\Base\BaseFromRequest;
use App\Http\Requests\Role\RoleRequest;
use App\Rules\TranslationValidator;
use Illuminate\Validation\Rule;

class EmployeeRequest extends BaseFromRequest
{
    protected array $attributesMap = [
        'firstName' => 'first_name',
        'lastName' => 'last_name',
        'imageId' => 'image_id',
    ];

    public function rules(): array
    {
        switch (request()->method()) {
            default:
            case 'POST':
                return [
                    'password' => ['required', 'string', 'min:8', 'max:100'],
                    'firstName' => ['required', 'string'],
                    'lastName' => ['required', 'string'],
                    'mobile' => ['required', 'string', 'size:9', 'regex:/^9\d{8}$/'],
                    'status' => ['required', Rule::in(UserStatus::values())],
                    'phone' => ['nullable', 'string', 'max:12'],
                    'note' => ['array', new TranslationValidator()],
                    'note.*' => ['nullable', 'string'],
                    'email' => ['required', 'email', 'max:40'],
                    'address' => ['nullable', 'string'],
                    'roles' => ['required', 'array', 'min:1'],
                    'roles.*' => [
                        'exists:roles,name',
                        Rule::notIn([RoleName::ADMIN->value, RoleName::SUPER_ADMIN->value])
                    ],
                    'imageId' => ['nullable', Rule::exists('media', 'id')],
                ];
            case 'PUT':
                return [
                    'password' => ['string', 'min:8', 'max:100'],
                    'firstName' => ['string'],
                    'lastName' => ['string'],
                    'mobile' => [
                        'string', 'size:9', 'regex:/^9\d{8}$/',
                        Rule::unique('users', 'mobile')
                            ->ignore($this->route()->employee)
                            ->whereNull('deleted_at')],
                    'status' => [Rule::in(UserStatus::values())],
                    'phone' => ['nullable', 'string', 'max:12',
                        Rule::unique('users', 'phone')
                            ->ignore($this->route()->employee)
                            ->whereNull('deleted_at')
                    ],
                    'note' => ['array', new TranslationValidator()],
                    'note.*' => ['nullable', 'string'],
                    'email' => [
                        'email', 'max:40',
                        Rule::unique('users')->ignore($this->route()->employee)->whereNull('deleted_at')
                    ],
                    'address' => ['nullable', 'string'],
                    'roles' => ['array', 'min:1'],
                    'roles.*' => [
                        Rule::exists('roles', 'name')->whereNull('deleted_at'),
                        Rule::notIn([RoleName::ADMIN->value, RoleName::SUPER_ADMIN->value])],
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
            $data['password'] = $this->password;
            $data['firstName'] = $this->firstName;
            $data['lastName'] = $this->lastName;
            $data['status'] = $this->status;
            $data['roles'] = $this->roles;
            $data['address'] = $this->address;
            $data['email'] = $this->email;
//            $data['gender'] = $this->gender;
//            $data['bloodType'] = $this->bloodType;
//            $data['phone'] = $this->phone;
            $data['note'] = $this->note;
//            $data['weight'] = $this->weight;
//            $data['height'] = $this->height;
//            $data['birthDate'] = $this->birthDate;
//            $data['cityId'] = $this->cityId;
            $data['imageId'] = $this->imageId;
//            $data['healthStatus'] = $this->healthStatus;

            $data = array_filter($data, function ($value) {
                return $value !== null;
            });
            $this->replace($data);
        }
    }
}
