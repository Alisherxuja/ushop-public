<?php
namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
class UserWithOrderSeeder extends \Illuminate\Database\Seeder
{
    public function run()
    {
//        $stuff = \App\User::query()
//            ->with(['roles' => function ($q) {
//                $q->whereIn('name', ['superAdmin', 'admin', 'contentManager']);
//            }])
//            ->get();

        $users = \App\User::query()
            ->with(['roles' => function ($q) {
                $q->whereIn('name', ['customer']);
            }])->get();

        foreach ($users as $user) {
            $this->info($user);
        }

    }

    private function info(\App\User $user)
    {

        $profile = \App\Models\Base\Users\UserProfile::query()->create([
            'user_id' => $user->id,
            'first_name' => $user->name,
            'last_name' => 'Last name',
            'gender' => 'm',
            'birth_date' => '1990-10-11',
            'local' => 'ru'
        ]);
        $address = \App\Models\Base\Users\UserAddress::query()->create([
            'user_id' => $user->id,
            'name' => 'Address',
            'address' => 'address',
            'phone' => '998970000000',
            'first_name' => $user->name,
            'last_name' => 'Last name',
            'landmark' => 'Land mark',
            'coordinates' => json_encode(['lat' => 69.168727, 'lng' => 41.244799]),
        ]);
        $location = \App\Models\Base\Settings\Location::query()
            ->where('name_ru', 'Город Ташкент')
            ->first();
        $orderAddress = \App\Models\Site\Orders\OrderAddress::query()->create([
            'location_id' => $location->id,
            'address' => $address->address,
            'coordinates' => $address->coordinates,
            'phone' => $address->phone,
            'first_name' => $address->first_name,
            'last_name' => $address->first_name,
            'landmark' => $address->landmark,
            'created_at' => now()
        ]);

        $delivery = \App\Models\Site\Site\DeliveryType::query()->limit(1)->inRandomOrder()->first();
        $courier = \App\Models\Site\Site\Courier::query()->limit(1)->inRandomOrder()->first();
        $products = \App\Models\Base\Suppliers\SupplierProduct::query()->limit(rand(1, 5))->inRandomOrder()->get();
        $price = $products->sum('price');

        $order = \App\Models\Base\Orders\Order::query()->create([
            'user_id' => $user->id,
            'order_address_id' => $orderAddress->id,
            'delivery_type_id' => $delivery->id,
            'price' => $price,
            'delivery_price' => $delivery->price,
            'total_price' => $price + $delivery->price,
            'courier_id' => $courier->id,
            'uuid' => \Illuminate\Support\Str::uuid(),
            'payment_type' => array_rand(\App\Models\Base\Site\PaymentType::list(), 1),
            'comment' => '',
            'status' => 10,
            'created_at' => now(),
        ]);
        $orderProduct = [];
        foreach ($products as $product) {
            $orderProduct[] = [
                'order_id' => $order->id,
                'product_id' => $product->id,
                'supplier_id' => $product->supplier_id,
                'qty' => 1,
                'discount' => $product->discount,
                'price' => $product->price,
                'status' => 10,
                'comment' => '',
                'created_at' => now(),
            ];
        }
        DB::table('order_products')->insert($orderProduct);
    }
}
