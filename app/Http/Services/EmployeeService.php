<?php

namespace App\Http\Services;

use App\Models\Base\BaseModel;
use App\Models\Employee;
use App\Http\Services\Base\CrudService;
use App\Models\User;


class EmployeeService extends CrudService
{
    public function __construct(protected UserService $userService)
    {
    }

    protected function getModelClass(): string
    {
        return Employee::class;
    }

    public function create(array $data): BaseModel
    {
        /** @var User $user */
        $user = User::where('users.mobile', $data['mobile'])->first();

        if (!$user) {
            $user = User::create($data);
            $this->userService->setRoles($user, $data['roles']);
            $data['user_id'] = $user->id;
            return parent::create($data);
        }
        //there employee take this mobile
        if ($user->employee) {
            abort(422, __('mobile already exist'));
        }
        $dataUser = $this->dataUser($data);
        $user->update($dataUser);
        $data['user_id'] = $user->id;
        return parent::create($data);
    }

    public function update(mixed $id, array $data): BaseModel
    {
        //todo admin & sys-admin
        $dataEmployee = $this->dataEmployee($data);
        $dataUser = $this->dataUser($data);

        /** @var Employee $employee */
        $employee = parent::update($id, $dataEmployee);
        /** @var User $user */
        $user = $this->userService->find($employee->user_id);
        $user->update($dataUser);
        $this->userService->setRoles($user, $data['roles'] ?? null);
        return $employee;
    }

    public function dataEmployee(array $data): array
    {
        $dataEmployee = [];

        if (isset($data['status'])) {
            $dataEmployee['status'] = $data['status'];
        }
        if (isset($data['national_identity_number'])) {
            $dataEmployee['national_identity_number'] = $data['national_identity_number'];
        }
        if (isset($data['birth_date'])) {
            $dataEmployee['birth_date'] = $data['birth_date'];
        }
        if (isset($data['city_id'])) {
            $dataEmployee['city_id'] = $data['city_id'];
        }
        if (isset($data['address'])) {
            $dataEmployee['address'] = $data['address'];
        }
        return $dataEmployee;
    }

    public function dataUser(array $data): array
    {
        $dataUser = [];

        if (isset($data['password'])) {
            $dataUser['password'] = $data['password'];
        }
        if (isset($data['first_name'])) {
            $dataUser['first_name'] = $data['first_name'];
        }
        if (isset($data['last_name'])) {
            $dataUser['last_name'] = $data['last_name'];
        }
        if (isset($data['image_id'])) {
            $dataUser['image_id'] = $data['image_id'];
        }
        if (isset($data['mobile'])) {
            $dataUser['mobile'] = $data['mobile'];
        }
        if (isset($data['phone'])) {
            $dataUser['phone'] = $data['phone'];
        }
        if (isset($data['note'])) {
            $dataUser['note'] = $data['note'];
        }
        if (isset($data['status'])) {
            $dataUser['status'] = $data['status'];
        }
        if (isset($data['email'])) {
            $dataUser['email'] = $data['email'];
        }

        return $dataUser;
    }
}
