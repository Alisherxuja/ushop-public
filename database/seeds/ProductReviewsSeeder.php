<?php

namespace Database\Seeders;

use App\Models\Admin\Products\Product;
use App\Models\Base\Orders\Order;
use App\User;
use Illuminate\Database\Seeder;

class ProductReviewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::query()->get();
        $users = User::query()->get();
        $orders = Order::query()->get();
        $data = [];
        foreach ($products as $product) {
            $limit = mt_rand(5, 50);
            for ($i = 1; $i < $limit; $i++) {
                $data[] = [
                    'product_id' => $product->id,
                    'user_id' => $users->random()->id,
                    'order_id' => $orders->random()->id,
                    'comment' => 'Повседневная практика показывает, что укрепление и развитие внутренней структуры создаёт предпосылки для инновационных методов управления процессами. В своём стремлении улучшить пользовательский опыт мы упускаем, что базовые сценарии поведения пользователей могут быть своевременно верифицированы.',
                    'rate' => mt_rand(1, 5),
                ];
            }
        }
        \DB::table('product_reviews')->insert($data);
    }
}
