<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Artel',
                'slug' => 'artel',
                'logo' => 'brands/artel.png'
            ]
        ];

        DB::table('brands')->insert($data);
    }
}
