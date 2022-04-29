<?php

namespace Database\Seeders;

use App\Models\Base\Settings\Setting;
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
        Setting::query()->create([
            'phone' => 998909090810,
            'email' => 'ushop@gmail.com',
            'company_name' => 'Ushop',
            'address_uz' => 'Address uz',
            'address_ru' => 'Address ru',
            'android_app_url' => 'https://google.com',
            'ios_app_url' => 'https://google.com',
        ]);
    }
}
