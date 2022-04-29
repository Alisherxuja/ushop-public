<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleSAdmin = \Spatie\Permission\Models\Role::findByName('superAdmin', 'api');
        $roleAdmin = \Spatie\Permission\Models\Role::findByName('admin', 'api');
        $roleSeller = \Spatie\Permission\Models\Role::findByName('developer', 'api');
        $roleCustomer = \Spatie\Permission\Models\Role::findByName('customer', 'api');
        $roleContentManager = \Spatie\Permission\Models\Role::findByName('contentManager', 'api');

        \App\User::query()->create([
            'name' => 'super admin',
            'phone' => '998970000001',
            'email' => 'superAdmin@gmail.com',
            'password' => Hash::make('admin12345'),
        ])->assignRole($roleSAdmin);
        \App\User::query()->create([
            'name' => 'admin',
            'phone' => '998970000002',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin12345'),
        ])->assignRole($roleAdmin);
        \App\User::query()->create([
            'name' => 'contentManager',
            'phone' => '998970000005',
            'email' => 'contentManager@gmail.com',
            'password' => Hash::make('admin12345'),
        ])->assignRole($roleContentManager);

        \App\User::query()->create([
            'name' => 'developer',
            'phone' => '998970000003',
            'email' => 'developer@gmail.com',
            'password' => Hash::make('admin12345'),
        ])->assignRole($roleSeller);

        \App\User::query()->create([
            'name' => 'customer1',
            'phone' => '998970000014',
            'email' => 'customer1@gmail.com',
            'password' => Hash::make('admin12345'),
        ])->assignRole($roleCustomer);
        \App\User::query()->create([
            'name' => 'customer2',
            'phone' => '998970000024',
            'email' => 'customer2@gmail.com',
            'password' => Hash::make('admin12345'),
        ])->assignRole($roleCustomer);
        \App\User::query()->create([
            'name' => 'customer3',
            'phone' => '998970000034',
            'email' => 'customer3@gmail.com',
            'password' => Hash::make('admin12345'),
        ])->assignRole($roleCustomer);
        \App\User::query()->create([
            'name' => 'customer4',
            'phone' => '998970000044',
            'email' => 'customer4@gmail.com',
            'password' => Hash::make('admin12345'),
        ])->assignRole($roleCustomer);

    }
}
