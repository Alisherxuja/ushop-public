<?php


namespace App\Services\Admin;


use Spatie\Permission\Models\Role;

class RoleService
{
    public function search(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return Role::query()->paginate();
    }

    public function list()
    {
        return Role::query()->get();
    }

    public function get(Role $role): Role
    {
        $role->permissions = $role->permissions()->pluck('name');
        return $role;
    }

    public function create($data): ?Role
    {
        $data['guard_name'] = 'api';
        $item = new Role();
        $item->fill($data);
        if ($item->save()) {
            $item->syncPermissions($data['permissions']);
            $item->permissions = $item->permissions()->pluck('name');
            return $item;
        }
        return null;
    }

    public function update($data, Role $role): ?Role
    {
        if ($role->update($data)) {
            $role->syncPermissions($data['permissions']);
            $role->permissions = $role->permissions()->pluck('name');
            return $role;
        }
        return null;
    }
}
