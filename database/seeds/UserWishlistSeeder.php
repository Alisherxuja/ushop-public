<?php
namespace Database\Seeders;

use App\Models\Base\Products\Product;

class UserWishlistSeeder extends \Illuminate\Database\Seeder
{
    public function run()
    {
        $users = \App\User::query()
            ->with(['roles' => function ($q) {
                $q->whereIn('name', ['customer']);
            }])->get();

        foreach ($users as $user) {
            $this->info($user);
        }
    }

    public function info(\App\User $user)
    {
        $products = Product::query()->limit(rand(1, 3))->inRandomOrder()->get();

        foreach ($products as $product) {
            \App\Models\Site\Users\Wishlist::query()->create([
                'user_id' => $user->id,
                'product_id' => $product->id
            ]);
        }
    }
}
