<?php

namespace App\Models\Base\Site;

use App\Models\Base\Orders\Order;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

/**
 * @property integer $id
 * @property string $name
 * @property integer $phone
 * @property string $car_number
 * @property string $car_type
 * @property string $car_model
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Order[] $orders
 */
class Courier extends Model
{
    use SoftDeletes;

    const STATUS_ACTIVE = 10;
    const STATUS_INACTIVE = 0;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['name', 'phone', 'car_number', 'car_type', 'car_model', 'status', 'created_at', 'updated_at', 'deleted_at'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany('App\Models\Base\Orders\Order');
    }

    public static function search(Request $request)
    {
        return self::query()
            ->where('status', self::STATUS_ACTIVE)
            ->when($request->name, function (Builder $query) use ($request) {
                $query->where('name', 'ilike', '%' . $request->name . '%');
            })
            ->when($request->phone, function (Builder $query) use ($request) {
                $query->where('phone', 'ilike', '%' . $request->phone . '%');
            })
            ->when($request->car_model, function (Builder $query) use ($request) {
                $query->where('car_model', 'ilike', '%' . $request->car_model . '%');
            })
            ->when($request->car_type, function (Builder $query) use ($request) {
                $query->where('car_type', 'ilike', '%' . $request->car_type . '%');
            })
            ->when($request->car_number, function (Builder $query) use ($request) {
                $query->where('car_number', 'ilike', '%' . $request->car_number . '%');
            })
            ->when(!is_null($request->status), function (Builder $query) use ($request) {
                $query->where('status', $request->status);
            });
    }
}
