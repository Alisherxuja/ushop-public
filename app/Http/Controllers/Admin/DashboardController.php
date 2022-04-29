<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            [
                'name' => 'Посещения за день',
                'data' => [
                    'number' => rand(10, 100),
                    'percent' => rand(-50, 50)
                ]
            ],
            [
                'name' => 'Заказы за месяц',
                'data' => [
                    'number' => 15,
                    'percent' => -51
                ]
            ],
            [
                'name' => 'Оборот за месяц',
                'data' => [
                    'number' => 2325700,
                    'percent' => 15
                ]
            ],
            [
                'name' => 'Конверсия',
                'data' => [
                    'number' => 1.6,
                    'percent' => -14
                ]
            ],
            [
                'name' => 'Новые заказы на сегодня',
                'data' => [
                    'number' => 5,
                    'percent' => 1505000
                ]
            ],
            [
                'name' => 'Заказы в обработке',
                'data' => [
                    'number' => 15,
                    'percent' => 15805000
                ]
            ],
            [
                'name' => 'Общее кол-во заказов на сегодня',
                'data' => [
                    'number' => 20,
                    'percent' => 25805000
                ]
            ],
        ];
        return success_out($data);
    }
}
