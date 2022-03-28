<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'name' => 'registration',
            'value' => '1',
        ]);

        Setting::create([
            'name' => 'deadline',
            'value' => '14:00:00',
        ]);
    }
}
