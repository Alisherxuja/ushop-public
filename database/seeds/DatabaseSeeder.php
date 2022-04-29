<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(UserSeederTable::class);
        $this->call(LocationsSeederTable::class);
        $this->call(CategorySeeder::class);
        $this->call(BrandsSeeder::class);

        $this->call(DeliveryTypeSeeder::class);
        $this->call(PaymentTypeSeeder::class);
        $this->call(MeasuresSeeder::class);
        $this->call(CourierSeeder::class);
        //$this->call(UserWithOrderSeeder::class);
        //$this->call(UserWishlistSeeder::class);

        $this->call(BannerSeeder::class);
        $this->call(SettingSeeder::class);

        $this->call(ProductsSeeder::class);
        $this->call(ProductAttachmentsSeeder::class);
    }
}
