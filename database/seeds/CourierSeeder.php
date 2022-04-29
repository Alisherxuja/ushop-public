<?php
namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
class CourierSeeder extends \Illuminate\Database\Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Jahongir',
                'phone' => 998990000001,
                'car_number' => '01F005QQ',
                'car_type' => 'Standard',
                'car_model' => 'Matiz',
                'status' => 10,
                'created_at' => now(),
            ],
            [
                'name' => 'Sardor',
                'phone' => 998990000002,
                'car_number' => '01Q015AQ',
                'car_type' => 'Comfort',
                'car_model' => 'Lacetti',
                'status' => 10,
                'created_at' => now(),
            ]
        ];

        DB::table('couriers')->insert($data);
    }
}
