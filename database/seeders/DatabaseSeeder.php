<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
/* use App\Models\Role;
use App\Models\User;
use App\Models\Setting;
use App\Models\Cat; */

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */



    //https://laravel.com/docs/8.x/seeding
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            SettingSeeder::class,
            CatSeeder::class,
        ]);

    }
}
