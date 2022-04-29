<?php

namespace App;

use App\Models\Base\Orders\Order;
use App\Models\Base\Users\UserAddress;
use App\Models\Base\Users\UserProfile;
use App\Models\Base\Users\Wishlist;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * Class User
 * @package App
 *
 * @property  integer $id
 * @property  string $name
 * @property  string $email
 * @property  string $phone
 * @property  integer $status
 * @property  string $password
 * @property  string $created_at
 * @property  string $updated_at
 * @property UserProfile $profile
 * @property Wishlist $wishlists
 * @property UserAddress $addresses
 * @property Order $orders
 * @property Order $lastOrders
 */
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;

    const STATUS_ACTIVE = 10;
    const STATUS_INACTIVE = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'password', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by', 'deleted_at', 'deleted_by'
    ];


    protected $hidden = [
        'password', 'remember_token', 'created_at', 'updated_at', 'created_by', 'updated_by', 'deleted_at', 'deleted_by'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public static function adminRolesList()
    {
        return [
            'admin' => 'Admin',
            'superAdmin' => 'Super admin'
        ];
    }

    public function setPassword($password)
    {
        $this->password = \Hash::make($password);
    }

    public function createOrUpdateProfile($data)
    {
        return UserProfile::query()->updateOrCreate(
            ['user_id' => $this->id],
            [
                'user_id' => $this->id,
                'first_name' => $data['name'],
                'last_name' => $data['last_name'] ?? null,
                'local' => \App::getLocale(),
            ]);
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class, 'user_id', 'id');
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class, 'user_id', 'id');
    }

    public function addresses()
    {
        return $this->hasMany(UserAddress::class, 'user_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id', 'id');
    }

    public function lastOrders()
    {
        return $this->hasMany(Order::class, 'updated_by', 'id');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
