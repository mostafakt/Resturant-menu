<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\User\UserStatus;
use App\Models\Area;
use App\Models\Client;
use App\Models\Driver;
use App\Models\DiscountCode;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,

            CategorySeeder::class,

            //   ConfigSeeder::class,


        ]);
    }
}
