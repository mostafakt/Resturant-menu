<?php

namespace Database\Seeders;

use App\Enums\Permission\PermissionName;
use App\Enums\Permission\RoleName;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::with([])->delete();
        Role::with([])->delete();

        $permissions = PermissionName::values();

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
