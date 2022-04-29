<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
class DeliveryTypeSeeder extends \Illuminate\Database\Seeder
{
    public function run()
    {
        $data = [
            [
                'name_ru' => 'Экспресс доставка',
                'name_uz' => 'Экспресс доставка',
                'description_ru' => 'Доставим в указанное время или за 2 часа с момента заказа',
                'description_uz' => 'Доставим в указанное время или за 2 часа с момента заказа',
                'short_info_ru' => 'Доставим в указанное время или за 2 часа с момента заказа',
                'short_info_uz' => 'Доставим в указанное время или за 2 часа с момента заказа',
                'price' => 50000,
                'is_default' => false,
                'status' => 10,
                'created_at' => now(),
            ],
            [
                'name_ru' => 'Самовывоз (pick-up point)',
                'name_uz' => 'Самовывоз (pick-up point)',
                'description_ru' => '',
                'description_uz' => '',
                'short_info_ru' => '',
                'short_info_uz' => '',
                'price' => 0,
                'is_default' => false,
                'status' => 10,
                'created_at' => now(),
            ],
            [
                'name_ru' => 'Бесконтактная доставка',
                'name_uz' => 'Бесконтактная доставка',
                'description_ru' => '',
                'description_uz' => '',
                'short_info_ru' => '',
                'short_info_uz' => '',
                'price' => 0,
                'is_default' => false,
                'status' => 10,
                'created_at' => now(),
            ]
        ];

        DB::table('delivery_types')->insert($data);
    }
}
