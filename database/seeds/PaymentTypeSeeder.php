<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
class PaymentTypeSeeder extends \Illuminate\Database\Seeder
{
    public function run()
    {
        $data = [
            [
                'name_ru' => 'PayMe',
                'name_uz' => 'PayMe',
                'is_default' => false,
                'type' => 'online',
                'status' => 10,
                'logo' => 'payment/CNjlPr19p5jKFlHdCPZ3bCLz4hdPDxiSTufU2YbO.png',
                'created_at' => now(),
            ],
//            [
//                'name_ru' => 'Click',
//                'name_uz' => 'Click',
//                'is_default' => false,
//                'type' => 'online',
//                'status' => 10,
//                'logo' => 'payment/798vkm5KtMig4T5QZOOTavDXu1I47GMNdPsTSfHJ.png',
//                'created_at' => now(),
//            ],
            [
                'name_ru' => 'Со сдачей',
                'name_uz' => 'Со сдачей',
                'is_default' => false,
                'type' => 'cash',
                'status' => 10,
                'logo' => 'payment/BAoO17EngnmZt34hnvpWneAtzQtyJez9ZgACOCNI.jpg',
                'created_at' => now(),
            ],
            [
                'name_ru' => 'Без сдачей',
                'name_uz' => 'Без сдачей',
                'is_default' => false,
                'type' => 'cash',
                'status' => 10,
                'logo' => 'payment/pv66tll5fEASsHaEcfxoMbntcGVKvQjMJdbUvvfi.jpg',
                'created_at' => now(),
            ],
//            [
//                'name_ru' => 'Перечислен',
//                'name_uz' => 'Перечислен',
//                'is_default' => false,
//                'type' => 'corporate',
//                'status' => 10,
//                'logo' => 'payment/M1RMSi7THWnIIQ3GYmr4DN7wBDNEQSoY3XbvdwZY.jpg',
//                'created_at' => now(),
//            ]
        ];

        DB::table('payment_types')->insert($data);
    }
}
