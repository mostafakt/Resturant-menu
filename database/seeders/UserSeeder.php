<?php

namespace Database\Seeders;

use App\Enums\Driver\StatusDriver;
use App\Enums\Permission\RoleName;
use App\Enums\Store\StoreStatus;
use App\Enums\Store\WorkStatus;
use App\Enums\User\UserStatus;
use App\Models\Client;
use App\Models\Driver;
use App\Models\Employee;
use App\Models\Investor;
use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use MatanYadaev\EloquentSpatial\Objects\Point;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //sys-admin
        if (!User::query()->find(1)) {
            /** @var User $user */
            $user = User::factory()->create([
                'id' => 1,
                'first_name' => 'sysadmin',
                'last_name' => 'sysadmin',
                'mobile' => '0955666777',
                'email' => 'sys-admin@test.com',
                'status' => UserStatus::ACTIVE,
            ]);

            //create employee
            $employee = Employee::factory()->create([
                'user_id' => $user->id,
            ]);
            $user->employee()->save($employee);
            $user->assignRole(RoleName::SUPER_ADMIN->value);
        }

        //admin
        if (!User::query()->find(2)) {
            $user = User::factory()->create([
                'id' => 2,
                'first_name' => 'admin',
                'last_name' => 'admin',
                'mobile' => '0955666111',
                'email' => 'admin@test.com',
                'status' => UserStatus::ACTIVE,
            ]);

            //create employee
            $employee = Employee::factory()->create([
                'user_id' => $user->id,
            ]);
            $user->employee()->save($employee);
            $user->assignRole(RoleName::ADMIN->value);
        }

        //client
        if (!User::query()->find(3)) {
            /** @var User $user */
            $user = User::factory()->create([
                'id' => 3,
                'first_name' => 'client',
                'last_name' => 'client',
                'mobile' => '997319558',
                'email' => 'client@test.com',
                'status' => UserStatus::ACTIVE,
            ]);
            //create client
            $client = Client::factory()->create([
                'user_id' => $user->id,
            ]);
            $user->client()->save($client);
            $user->assignRole(RoleName::CLIENT->value);
        }


    }
}
