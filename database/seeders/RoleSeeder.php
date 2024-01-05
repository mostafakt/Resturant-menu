<?php

namespace Database\Seeders;

use App\Enums\Permission\PermissionName;
use App\Enums\Permission\RoleName;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // <editor-fold default-state="collapsed" desc="super-admin">
        /** @var Role $role */
        $role = Role::create(['name' => RoleName::SUPER_ADMIN->value]);
        $role->syncPermissions(PermissionName::values());
//        $role->revokePermissionTo(PermissionName::CAN_VIEW_PADS->value);
        // </editor-fold>

        // <editor-fold default-state="collapsed" desc="admin">
        /** @var Role $role */
        $role = Role::create(['name' => RoleName::ADMIN->value]);
        $role->syncPermissions(PermissionName::values());
//        $role->revokePermissionTo(PermissionName::CAN_VIEW_PADS->value);
        // </editor-fold>

        // <editor-fold default-state="collapsed" desc="client">
        /** @var Role $role */
        $role = Role::create(['name' => RoleName::CLIENT->value]);
        $role->syncPermissions([
            PermissionName::CAN_VIEW_CATEGORY->value,
        ]);
        // </editor-fold>


    }
}
