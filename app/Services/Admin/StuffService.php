<?php


namespace App\Services\Admin;


use App\Http\Resources\Admin\OrderResource;
use App\Http\Resources\Admin\UserResource;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class StuffService
{
    public function search(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $users = User::query()
            ->with(['roles' => function ($q) {
                return $q->select(['roles.name']);
            }])
//            ->role(['contentManager', 'admin', 'superAdmin'])
            ->paginate();
        return UserResource::collection($users);
    }

    public function get(User $user): array
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'status' => $user->status,
            'roles' => $user->roles()->select(['name'])->pluck('name'),
            'profile' => [
                'id' => optional($user->profile)->id,
                'first_name' => optional($user->profile)->first_name,
                'last_name' => optional($user->profile)->last_name,
                'gender' => optional($user->profile)->gender,
                'birth_date' => optional($user->profile)->birth_date,
                'local' => optional($user->profile)->local,
            ],
            'last_orders' => OrderResource::collection($user->lastOrders)
        ];
    }

    public function create($data): ?array
    {
        $user = new User();
        $user->fill($data);
        $user->setPassword($data['password']);
        if ($user->save()) {
            $role = Role::findByName($data['role_name']);
            $user->assignRole($role);
            $user->createOrUpdateProfile($data);
            return $this->get($user);
        }
        return null;
    }

    public function update($data, User $user): ?array
    {
        if ($user->update($data)) {
            $role = Role::findByName($data['role_name']);
            $user->syncRoles($role);
            $user->createOrUpdateProfile($data);
            return $this->get($user);
        }
        return null;
    }
}
