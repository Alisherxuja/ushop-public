<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannerSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'url' => 'discounts/ezhenedelnye-skidki',
                'image' => 'banners/ru1.jpg'
            ],
            [
                'url' => 'discounts/ezhenedelnye-skidki',
                'image' => 'banners/ru2.jpg'
            ],
            [
                'url' => 'discounts/ezhenedelnye-skidki',
                'image' => 'banners/ru3.jpg'
            ]
        ];

        DB::table('banners')->insert($data);
        $data = [
            ['image' => 'adds/Wh7frOdt2Uu1Bsb4thVclUFrEucRgKoN9AgODgoJ.jpg'],
            ['image' => 'adds/9oVZInXfovoTJuEgxFtUv062APZuj4ZeSDcSdilc.jpg'],
            ['image' => 'adds/EBzh9jKOvgIKWBc4zg48b4CpeKnMzKvajBUsK6l7.jpg'],
            ['image' => 'adds/FXwjlDQ40JJa1MKM2R0zMNT3jI2A7zw29UnOTnEL.png'],
            ['image' => 'adds/57WJfJ9X0W2ifmi4gjr7RIVnzKr8JsLNmizeAYmq.jpg'],
        ];
        DB::table('adds')->insert($data);

    }
}
