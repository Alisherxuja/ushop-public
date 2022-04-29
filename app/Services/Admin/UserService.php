<?php


namespace App\Services\Admin;


use App\Http\Resources\Admin\ComplaintResource;
use App\Http\Resources\Admin\OrderResource;
use App\Http\Resources\Admin\UserAddressResource;
use App\Http\Resources\Admin\UserResource;
use App\Http\Resources\Admin\WishlistResource;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserService
{
    protected User $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function list(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $users = User::query()
            ->with(['roles' => function ($q) {
                return $q->select(['roles.name']);
            }])
            ->get();

        return UserResource::collection($users);
    }

    public function search(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $users = User::query()
            ->with(['roles' => function ($q) {
                return $q->select(['roles.name']);
            }])
            //->role(['seller', 'customer'])
            ->paginate();

        return UserResource::collection($users);
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
            'addresses' => UserAddressResource::collection($user->addresses),
            'wishlists' => WishlistResource::collection($user->wishlists),
            'orders' => OrderResource::collection($user->orders),
        ];
    }
}
