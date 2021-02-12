<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        Setting::create([
            'email' => 'contact@skillshub.com',
            'phone' => '01016221822',
            'facebook' => 'contact@skillshub.com',
            'twitter' => 'contact@skillshub.com',
            'instagram' => 'contact@skillshub.com',
            'youtube' => 'contact@skillshub.com',
            'linkedin' => 'contact@skillshub.com',
        ]);
    }
}
