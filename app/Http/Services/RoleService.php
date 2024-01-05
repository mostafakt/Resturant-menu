<?php

namespace App\Http\Services;

use App\Enums\Permission\RoleName;
use App\Http\Services\Base\CrudService;
use Spatie\Permission\Models\Role;


class RoleService extends CrudService
{
    protected function getModelClass(): string
    {
        return Role::class;
    }

    public function createRole(array $data)
    {
        $role = Role::findOrCreate($data['name']);

        if (in_array($role->name, RoleName::values(), true)) {
            abort(400, __('exceptions.role.fixed_role'));
        }

        $role->syncPermissions($data['permissions']);

        return $role;
    }

    public function updateRole(Role $role, $data)
    {
        if (in_array($role->name, RoleName::values(), true)) {
            abort(400, __('exceptions.role.fixed_role'));
        }

        $role->update($data);

        return $role;
    }

    public function deleteRole(Role $role): void
    {
        if (in_array($role->name, RoleName::values(), true)) {
            abort(400, __('exceptions.role.fixed_role'));
        }

        $role->delete();
    }


}
