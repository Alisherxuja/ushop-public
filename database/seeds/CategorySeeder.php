<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'parent_id' => null,
                'name_uz' => 'Овощи, зелень',
                'name_ru' => 'Овощи, зелень',
                'slug' => 'овощи-зелень',
                'status' => 10
            ],
            [
                'id' => 2,
                'parent_id' => null,
                'name_uz' => 'Фрукты и сухофрукты',
                'name_ru' => 'Фрукты и сухофрукты',
                'slug' => 'фрукты-и-сухофрукты',
                'status' => 10
            ],
            [
                'id' => 3,
                'parent_id' => null,
                'name_uz' => 'Молочные продукты, сыр, яйца',
                'name_ru' => 'Молочные продукты, сыр, яйца',
                'slug' => 'молочные-продукты-сыр-яйца',
                'status' => 10
            ],
            [
                'id' => 4,
                'parent_id' => null,
                'name_uz' => 'Мясо и рыба',
                'name_ru' => 'Мясо и рыба',
                'slug' => 'мясо-и-рыба',
                'status' => 10
            ],

            [
                'id' => 5,
                'parent_id' => 1,
                'name_uz' => 'Зелень',
                'name_ru' => 'Зелень',
                'slug' => 'зелень',
                'status' => 10
            ],
            [
                'id' => 6,
                'parent_id' => 1,
                'name_uz' => 'Овощи',
                'name_ru' => 'Овощи',
                'slug' => 'овощи',
                'status' => 10
            ],
            [
                'id' => 7,
                'parent_id' => 2,
                'name_uz' => 'Фрукты и ягоды',
                'name_ru' => 'Фрукты и ягоды',
                'slug' => 'фрукты-и-ягоды',
                'status' => 10
            ],
            [
                'id' => 8,
                'parent_id' => 2,
                'name_uz' => 'Сухофрукты',
                'name_ru' => 'Сухофрукты',
                'slug' => 'сухофрукты',
                'status' => 10
            ],
        ];

        DB::table('categories')->insert($data);

    }
}
