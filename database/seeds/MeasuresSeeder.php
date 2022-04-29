<?php
namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
class MeasuresSeeder extends \Illuminate\Database\Seeder
{
    public function run()
    {
        $data = [
            [
                'name_ru' => 'Килограмм',
                'name_uz' => 'Kilogram',
                'symbol_uz' => 'Kg',
                'symbol_ru' => 'Кг',
                'status' => 10,
                'created_at' => now(),
            ],
            [
                'name_ru' => 'Штук',
                'name_uz' => 'Dona',
                'symbol_uz' => 'Ta',
                'symbol_ru' => 'Шт',
                'status' => 10,
                'created_at' => now(),
            ],
        ];

        DB::table('measures')->insert($data);
    }
}
