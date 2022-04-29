<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \Spatie\Permission\Models\Role::create([
            'name' => 'superAdmin',
            'guard_name' => 'api'
        ]);
        \Spatie\Permission\Models\Role::create([
            'name' => 'admin',
            'guard_name' => 'api'
        ]);
        \Spatie\Permission\Models\Role::create([
            'name' => 'customer',
            'guard_name' => 'api'
        ]);
        \Spatie\Permission\Models\Role::create([
            'name' => 'developer',
            'guard_name' => 'api'
        ]);
        \Spatie\Permission\Models\Role::create([
            'name' => 'contentManager',
            'guard_name' => 'api'
        ]);
    }

}
