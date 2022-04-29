<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $actionList = \App\Helpers\Permissions::list();
        $c_at = new \Carbon\Carbon();
        $permissions = [];
        $permissions1 = [];
        foreach ($actionList as $perm) {
            $permissions[] = [
                'name' => $perm['name'],
                'guard_name' => config('auth.defaults.guard'),
                'created_at' => $c_at,
                'updated_at' => $c_at,
            ];
            $permissions1[] = $perm['name'];
        }
        \Spatie\Permission\Models\Permission::query()->delete();
        \Spatie\Permission\Models\Permission::query()->insert($permissions);
        $role = \Spatie\Permission\Models\Role::findByName('superAdmin');
        $role->syncPermissions($permissions1);
    }
}
